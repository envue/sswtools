<?php

namespace App\Http\Controllers\Admin;

use App\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentPagesRequest;
use App\Http\Requests\Admin\UpdateContentPagesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class ContentPagesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of ContentPage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('content_page_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = ContentPage::query();
            $query->with("category_id");
            $query->with("tag_id");
            $template = 'actionsTemplate';
            
            $query->select([
                'content_pages.id',
                'content_pages.title',
                'content_pages.page_text',
                'content_pages.excerpt',
                'content_pages.featured_image',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'content_page_';
                $routeKey = 'admin.content_pages';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('category_id.title', function ($row) {
                if(count($row->category_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->category_id->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('tag_id.title', function ($row) {
                if(count($row->tag_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->tag_id->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('page_text', function ($row) {
                return $row->page_text ? $row->page_text : '';
            });
            $table->editColumn('excerpt', function ($row) {
                return $row->excerpt ? $row->excerpt : '';
            });
            $table->editColumn('featured_image', function ($row) {
                if($row->featured_image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->featured_image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->featured_image) .'"/>'; };
            });
            $table->editColumn('attachments', function ($row) {
                $build  = '';
                foreach ($row->getMedia('attachments') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });

            $table->rawColumns(['actions','massDelete','category_id.title','tag_id.title','featured_image']);

            return $table->make(true);
        }

        return view('admin.content_pages.index');
    }

    /**
     * Show the form for creating new ContentPage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('content_page_create')) {
            return abort(401);
        }
        
        $category_ids = \App\ContentCategory::get()->pluck('title', 'id');

        $tag_ids = \App\ContentTag::get()->pluck('title', 'id');


        return view('admin.content_pages.create', compact('category_ids', 'tag_ids'));
    }

    /**
     * Store a newly created ContentPage in storage.
     *
     * @param  \App\Http\Requests\StoreContentPagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentPagesRequest $request)
    {
        if (! Gate::allows('content_page_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $content_page = ContentPage::create($request->all());
        $content_page->category_id()->sync(array_filter((array)$request->input('category_id')));
        $content_page->tag_id()->sync(array_filter((array)$request->input('tag_id')));


        foreach ($request->input('attachments_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $content_page->id;
            $file->save();
        }

        return redirect()->route('admin.content_pages.index');
    }


    /**
     * Show the form for editing ContentPage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('content_page_edit')) {
            return abort(401);
        }
        
        $category_ids = \App\ContentCategory::get()->pluck('title', 'id');

        $tag_ids = \App\ContentTag::get()->pluck('title', 'id');


        $content_page = ContentPage::findOrFail($id);

        return view('admin.content_pages.edit', compact('content_page', 'category_ids', 'tag_ids'));
    }

    /**
     * Update ContentPage in storage.
     *
     * @param  \App\Http\Requests\UpdateContentPagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentPagesRequest $request, $id)
    {
        if (! Gate::allows('content_page_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $content_page = ContentPage::findOrFail($id);
        $content_page->update($request->all());
        $content_page->category_id()->sync(array_filter((array)$request->input('category_id')));
        $content_page->tag_id()->sync(array_filter((array)$request->input('tag_id')));


        $media = [];
        foreach ($request->input('attachments_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $content_page->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $content_page->updateMedia($media, 'attachments');

        return redirect()->route('admin.content_pages.index');
    }


    /**
     * Display ContentPage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('content_page_view')) {
            return abort(401);
        }
        $content_page = ContentPage::findOrFail($id);

        return view('admin.content_pages.show', compact('content_page'));
    }


    /**
     * Remove ContentPage from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('content_page_delete')) {
            return abort(401);
        }
        $content_page = ContentPage::findOrFail($id);
        $content_page->deletePreservingMedia();

        return redirect()->route('admin.content_pages.index');
    }

    /**
     * Delete all selected ContentPage at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('content_page_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ContentPage::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

}
