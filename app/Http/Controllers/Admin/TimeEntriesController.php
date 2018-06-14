<?php

namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeEntriesRequest;
use App\Http\Requests\Admin\UpdateTimeEntriesRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class TimeEntriesController extends Controller
{
    /**
     * Display a listing of TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('time_entry_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('TimeEntry.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('TimeEntry.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = TimeEntry::query();
            $query->with("work_type");
            $query->with("student");
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            
            $query->select([
                'time_entries.id',
                'time_entries.start_time',
                'time_entries.end_time',
                'time_entries.work_type_id',
                'time_entries.population_type',
                'time_entries.caseload',
                'time_entries.description',
                'time_entries.notes',
                'time_entries.created_by_id',
                'time_entries.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'time_entry_';
                $routeKey = 'admin.time_entries';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('work_type.name', function ($row) {
                return $row->work_type ? $row->work_type->name : '';
            });
            $table->editColumn('population_type', function ($row) {
                return $row->population_type ? $row->population_type : '';
            });
            $table->editColumn('caseload', function ($row) {
                return $row->caseload ? $row->caseload : '';
            });
            $table->editColumn('student.identifier', function ($row) {
                if(count($row->student) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->student->pluck('identifier')->toArray()) . '</span>';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete','student.identifier']);

            return $table->make(true);
        }

        return view('admin.time_entries.index');
    }

    /**
     * Show the form for creating new TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('time_entry_create')) {
            return abort(401);
        }
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $students = \App\Student::get()->pluck('identifier', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.time_entries.create', compact('work_types', 'students', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created TimeEntry in storage.
     *
     * @param  \App\Http\Requests\StoreTimeEntriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeEntriesRequest $request)
    {
        if (! Gate::allows('time_entry_create')) {
            return abort(401);
        }
        $time_entry = TimeEntry::create($request->all());
        $time_entry->student()->sync(array_filter((array)$request->input('student')));



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Show the form for editing TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $students = \App\Student::get()->pluck('identifier', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.edit', compact('time_entry', 'work_types', 'students', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update TimeEntry in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeEntriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeEntriesRequest $request, $id)
    {
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->update($request->all());
        $time_entry->student()->sync(array_filter((array)$request->input('student')));



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Display TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('time_entry_view')) {
            return abort(401);
        }
        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.show', compact('time_entry'));
    }


    /**
     * Remove TimeEntry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('time_entry_delete')) {
            return abort(401);
        }
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->delete();

        return redirect()->route('admin.time_entries.index');
    }

    /**
     * Delete all selected TimeEntry at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('time_entry_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TimeEntry::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
