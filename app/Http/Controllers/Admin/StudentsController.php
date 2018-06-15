<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentsRequest;
use App\Http\Requests\Admin\UpdateStudentsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class StudentsController extends Controller
{
    /**
     * Display a listing of Student.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('student_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Student.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Student.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Student::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'students.id',
                'students.identifier',
                'students.created_by_id',
                'students.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'student_';
                $routeKey = 'admin.students';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('identifier', function ($row) {
                return $row->identifier ? $row->identifier : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    /**
     * Show the form for creating new Student.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.students.create', compact('created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param  \App\Http\Requests\StoreStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsRequest $request)
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }
        $student = Student::create($request->all());



        return redirect()->route('admin.students.index');
    }


    /**
     * Show the form for editing Student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('student_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $student = Student::findOrFail($id);

        return view('admin.students.edit', compact('student', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Student in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentsRequest $request, $id)
    {
        if (! Gate::allows('student_edit')) {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $student->update($request->all());



        return redirect()->route('admin.students.index');
    }


    /**
     * Display Student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('student_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $time_entries = \App\TimeEntry::whereHas('student',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $student = Student::findOrFail($id);

        return view('admin.students.show', compact('student', 'time_entries'));
    }


    /**
     * Remove Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index');
    }

    /**
     * Delete all selected Student at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Student::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('admin.students.index');
    }

    /**
     * Permanently delete Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->forceDelete();

        return redirect()->route('admin.students.index');
    }
}
