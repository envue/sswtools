<?php

namespace App\Http\Controllers\Admin;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserProfilesRequest;
use App\Http\Requests\Admin\UpdateUserProfilesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class UserProfilesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of UserProfile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_profile_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = UserProfile::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('user_profile_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'user_profiles.id',
                'user_profiles.title',
                'user_profiles.num_schools',
                'user_profiles.profile_image',
                'user_profiles.location_address',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_profile_';
                $routeKey = 'admin.user_profiles';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('num_schools', function ($row) {
                return $row->num_schools ? $row->num_schools : '';
            });
            $table->editColumn('profile_image', function ($row) {
                if($row->profile_image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->profile_image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->profile_image) .'"/>'; };
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            $table->rawColumns(['actions','massDelete','profile_image']);

            return $table->make(true);
        }

        return view('admin.user_profiles.index');
    }

    /**
     * Show the form for creating new UserProfile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_profile_create')) {
            return abort(401);
        }
        return view('admin.user_profiles.create');
    }

    /**
     * Store a newly created UserProfile in storage.
     *
     * @param  \App\Http\Requests\StoreUserProfilesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserProfilesRequest $request)
    {
        if (! Gate::allows('user_profile_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $user_profile = UserProfile::create($request->all());



        return redirect()->route('admin.user_profiles.index');
    }


    /**
     * Show the form for editing UserProfile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_profile_edit')) {
            return abort(401);
        }
        $user_profile = UserProfile::findOrFail($id);

        return view('admin.user_profiles.edit', compact('user_profile'));
    }

    /**
     * Update UserProfile in storage.
     *
     * @param  \App\Http\Requests\UpdateUserProfilesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfilesRequest $request, $id)
    {
        if (! Gate::allows('user_profile_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $user_profile = UserProfile::findOrFail($id);
        $user_profile->update($request->all());



        return redirect()->route('admin.user_profiles.index');
    }


    /**
     * Display UserProfile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_profile_view')) {
            return abort(401);
        }
        $user_profile = UserProfile::findOrFail($id);

        return view('admin.user_profiles.show', compact('user_profile'));
    }


    /**
     * Remove UserProfile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_profile_delete')) {
            return abort(401);
        }
        $user_profile = UserProfile::findOrFail($id);
        $user_profile->delete();

        return redirect()->route('admin.user_profiles.index');
    }

    /**
     * Delete all selected UserProfile at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_profile_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = UserProfile::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore UserProfile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('user_profile_delete')) {
            return abort(401);
        }
        $user_profile = UserProfile::onlyTrashed()->findOrFail($id);
        $user_profile->restore();

        return redirect()->route('admin.user_profiles.index');
    }

    /**
     * Permanently delete UserProfile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('user_profile_delete')) {
            return abort(401);
        }
        $user_profile = UserProfile::onlyTrashed()->findOrFail($id);
        $user_profile->forceDelete();

        return redirect()->route('admin.user_profiles.index');
    }
}
