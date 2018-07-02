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
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index()
    {
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $students = \App\Student::get()->pluck('identifier', 'id');

        //Create an array of option attribute
        $work_types_descriptions = \App\TimeWorkType::get()
        ->mapWithKeys(function ($item) {
                        return [$item->id => ['title' => $item->description]];
                    })->all();

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        
        return view('admin.calendar', compact('studentTest', 'work_types', 'work_types_descriptions','students', 'created_bies', 'created_by_teams'));
    }

    /**
     * Format time entries as json event data for ajax call.
     */
    public function getEvents()
    {  
        $time_entries  = \App\TimeEntry::with('work_type')
            ->with('student')
            ->get();
        
        $events = []; 
        foreach ($time_entries as $time_entry) { 
           $id = $time_entry->getOriginal('id'); 

           if (! $id) {
               continue;
           }

           $worktype  = $time_entry->work_type_id;
           
           $color     = [];
            if ($worktype == '1') {$color = '#3c8dbc';}  
            elseif ($worktype == '2'){$color = '#dd4b39';}
            elseif ($worktype == '3'){$color = '#00a65a';} 
            elseif ($worktype == '4'){$color = '#00c0ef';} 
            elseif ($worktype == '5'){$color = '#0073b7';} 
            elseif ($worktype == '6'){$color = '#001F3F';} 
            elseif ($worktype == '7'){$color = '#39CCCC';} 
            elseif ($worktype == '8'){$color = '#3D9970';} 
            elseif ($worktype == '9'){$color = '#01FF70';} 
            elseif ($worktype == '10'){$color = '#FF851B';} 
            elseif ($worktype == '11'){$color = '#F012BE';} 
            elseif ($worktype == '12'){$color = '#605ca8';} 
            elseif ($worktype == '13'){$color = '#D81B60';} 
            elseif ($worktype == '14'){$color = '#111';} 
            elseif ($worktype == '15'){$color = '#d2d6de';} 
            else {$color = '#f39c12';}             

           $events[]       = [ 
                'id'    => $id,
                'work_type' => $worktype,
                'population_type' => $time_entry->population_type,
                'caseload'   => $time_entry->caseload,
                'description' => $time_entry->description,
                'student' =>$time_entry->student->pluck('id')->toArray(),
                'title' => $time_entry->work_type->name.': '.$time_entry->description, 
                'start' => $time_entry->start_time,
                'end'   => $time_entry->end_time,
                'notes' => $time_entry->notes,
                'color' => $color
                //'url'   => route('admin.timeentries.edit', $timeentry->id),
           ]; 
        }

        
        return $events;
    }

     /**
     * Store a newly created TimeEntry in storage when user submits the modal form.
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

        return response()->json(['responseText' => 'Success!'], 200);
    }
    
    /**
     * Update TimeEntry in storage when event id dragged or resized.
     */
    public function update(Request $request, $id)
    {
        //
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        
        $time_entry = TimeEntry::where('id', $id)     
            ->update([    
            'start_time'=> $request->input('start_time'),
            'end_time'=> $request->input('end_time'),  
      ]);
              
        return response()->json(['responseText' => 'Success!'], 200);

    }

    /**
     * Delete TimeEntry from storage.
     */
    public function destroy($id)
    {
        //
        if (! Gate::allows('time_entry_delete')) {
            return abort(401);
        }
           
        $time_entry = TimeEntry::where('id', $id);
        $time_entry ->delete();

        return response()->json(['responseText' => 'Success!'], 200);
    }

    
    /**
     * Update TimeEntry when user clicks the event and submits the modal form.
     */
    public function formUpdate(UpdateTimeEntriesRequest $request, $id)
    {
        //
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->update($request->all());
        $time_entry->student()->sync(array_filter((array)$request->input('student')));
        
        
        return response()->json(['responseText' => 'Success!'], 200);
    }

}
