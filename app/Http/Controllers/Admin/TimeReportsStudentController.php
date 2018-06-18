<?php
namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeReportsStudentController extends Controller
{
    public function index(Request $r)
    {
        $students = \App\Student::get()->pluck('identifier', 'id');

        $studentId = $r->query('student_id');
        $from = Carbon::parse($r->query('from', Carbon::now()->subDays(30)));
        $to   = Carbon::parse($r->query('to', Carbon::now()))->endOfDay();
        

        $time_entries = TimeEntry::with('work_type')
            ->whereHas('student', function($q) use ($studentId) {
                $q->where('id', $studentId);
            })
            ->whereBetween('start_time', [$from, $to])
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

        
        

        // Chart data
        
        $workTypeLabels = array_column($work_type_time, 'name');
        $workTypeData = array_column($work_type_time, 'time');

        //total minutes for calculating percent in chart
        $workTypeMinutes = array_sum($workTypeData);

        // Time entered infobox
        $totalhours = floor(array_sum($workTypeData) / 60);
        $remaining_minutes = array_sum($workTypeData) % 60;

        // Number of weekdays infobox
        $weekdays = $from->diffInWeekdays($to);

        // Non-compensated time infobox
        $entriescount = count($time_entries);

        return view('admin.time_reports_student.index', compact(
            'students',
            'work_type_time',
            'workTypeData',
            'workTypeLabels',
            'workTypeMinutes',
            'totalhours',
            'remaining_minutes',
            'entriescount',
            'time_entries'   
        ));
    }
}
