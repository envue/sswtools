<?php
namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeReportsController extends Controller
{
    public function index(Request $r)
    {
        $from = Carbon::parse($r->query('from', Carbon::now()->subDays(30)));
        $to   = Carbon::parse($r->query('to', Carbon::now()))->endOfDay();

        $time_entries = TimeEntry::with('work_type')
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

        
        $time_entries_populations = TimeEntry::whereBetween('start_time', [$from, $to])
            ->whereNotNull ('population_type')
            ->where('population_type', '!=' , '0')
            ->get();
        
        $population_type_time = [];
        
        foreach ($time_entries_populations as $time_entry) {
            $begin = Carbon::parse($time_entry->start_time, 'Europe/Vilnius');
            $end   = Carbon::parse($time_entry->end_time, 'Europe/Vilnius');
            $diff  = $begin->diffInMinutes($end);
            if (!isset($population_type_time[$time_entry->population_type])) {
                $population_type_time[$time_entry->population_type] = [
                    'name' => $time_entry->population_type,
                    'time' => $begin->diffInMinutes($end),
                ];
            } else {
                $population_type_time[$time_entry->population_type]['time'] += $begin->diffInMinutes($end);
            }            
        }

        $time_entries_caseload = TimeEntry::whereBetween('start_time', [$from, $to])
            ->whereNotNull ('caseload')
            ->where('caseload', '!=' , '0')
            ->get();
        
        $caseload_time = [];
        
        foreach ($time_entries_caseload as $time_entry) {
            $begin = Carbon::parse($time_entry->start_time, 'Europe/Vilnius');
            $end   = Carbon::parse($time_entry->end_time, 'Europe/Vilnius');
            $diff  = $begin->diffInMinutes($end);
            if (!isset($caseload_time[$time_entry->caseload])) {
                $caseload_time[$time_entry->caseload] = [
                    'name' => $time_entry->caseload,
                    'time' => $begin->diffInMinutes($end),
                ];
            } else {
                $caseload_time[$time_entry->caseload]['time'] += $begin->diffInMinutes($end);
            }            
        }

        // Chart data
        
        $workTypeLabels = array_column($work_type_time, 'name');
        $workTypeData = array_column($work_type_time, 'time');

        $populationTypeLabels = array_column($population_type_time, 'name');
        $populationTypeData = array_column($population_type_time, 'time');

        $caseloadTypeLabels = array_column($caseload_time, 'name');
        $caseloadTypeData = array_column($caseload_time, 'time');

        //total minutes for calculating percent in chart
        $workTypeMinutes = array_sum($workTypeData);
        $populationTypeMinutes = array_sum($populationTypeData);
        $caseloadTypeMinutes = array_sum($caseloadTypeData);

        // Time entered infobox
        $totalhours = floor(array_sum($workTypeData) / 60);
        $remaining_minutes = array_sum($workTypeData) % 60;

        // Number of weekdays infobox
        $weekdays = $from->diffInWeekdays($to);

        // Non-compensated time infobox
        $daily_work_hours = 7.5;
        $work_minutes = $daily_work_hours * 60;
        $expected_work_time = $weekdays * $work_minutes; //output in minutes
        $noncomp_hours = max(floor(($workTypeMinutes - $expected_work_time) / 60 ), 0); //returns 0 if negative
        $noncomp_minutes = max(($workTypeMinutes - $expected_work_time) % 60 , 0);
        $entriescount = count($time_entries);

        return view('admin.time_reports.index', compact(
            'population_type_time',
            'caseload_time',
            'work_type_time',
            'workTypeData',
            'populationTypeData',
            'caseloadTypeData',
            'workTypeLabels',
            'populationTypeLabels',
            'caseloadTypeLabels',
            'totalhours',
            'remaining_minutes',
            'weekdays',
            'noncomp_minutes',
            'noncomp_hours',
            'entriescount',
            'workTypeMinutes',
            'populationTypeMinutes',
            'caseloadTypeMinutes'
        ));
    }
}
