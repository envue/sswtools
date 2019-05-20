<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        
        //variables for tables
        $timeentries = \App\TimeEntry::with('work_type')->latest()->limit(5)->get();
        $students_list = \App\Student::all(); 

        //variables for Gist script to identify users     
        $userID = \Auth::user()->id;
        $userEmail = \Auth::user()->email;
        $userName = \Auth::user()->name;
        $userRole = \Auth::user()->role->title;
        $userTeam = isset(\Auth::user()->team->name) ? : "";
        $timeEntriesAll = \App\TimeEntry::whereHas('created_by', function($q) use ($userId) {
            $q->where('id', $userId);
        });

        //chart time data for last 30 days
        $time_entries = \App\TimeEntry::with('work_type')
            ->whereBetween('start_time', [Carbon::parse(Carbon::now()->subDays(30)), Carbon::parse(Carbon::now()->endOfDay())])
            ->get();

            $work_type_time = [];
        
            foreach ($time_entries as $time_entry) {
                $begin = Carbon::parse($time_entry->start_time, 'Europe/Vilnius');
                $end   = Carbon::parse($time_entry->end_time, 'Europe/Vilnius');
                $diff  = $begin->diffInMinutes($end);
                if (!isset($work_type_time[$time_entry->work_type->id])) {
                    $work_type_time[$time_entry->work_type->id] = [
                        'name' => $time_entry->work_type->name,
                        'time' => $begin->diffInMinutes($end),
                    ];
                } else {
                    $work_type_time[$time_entry->work_type->id]['time'] += $begin->diffInMinutes($end);
                }            
            }

            $workTypeLabels = array_column($work_type_time, 'name');
            $workTypeData = array_column($work_type_time, 'time');

        //Calendar and modal form variables
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id', 'description')->prepend(trans('quickadmin.qa_please_select'), '');
        
        //Create an array of option attribute
        $work_types_descriptions = \App\TimeWorkType::get()
        ->mapWithKeys(function ($item) {
                        return [$item->id => ['title' => $item->description]];
                    })->all();

        $students = \App\Student::get()->pluck('identifier', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

     
        return view('home', compact(
            'timeentries',
            'timeEntriesAll',
            'students_list', 
            'userID', 
            'userEmail', 
            'userName', 
            'userRole', 
            'userTeam', 
            'workTypeLabels', 
            'workTypeData', 
            'work_types', 
            'students', 
            'created_bies', 
            'created_by_teams',
            'work_types_descriptions' 
        ));
    }
}
