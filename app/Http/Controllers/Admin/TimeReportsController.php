<?php
namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TimeReportsController extends Controller
{
    public function index(Request $r)
    {
        if (! Gate::allows('report_access')) {
            return abort(401);
        }
        $users = \App\User::get()->pluck('name', 'id');

        $userId = $r->query('user_id');
        $caseload_filter = $r->query('caseload_filter');

        if (isset($r->date_filter)) {
            $parts = explode(' - ' , $r->date_filter);
            $from = Carbon::parse($parts[0])->startOfDay();
            $to = Carbon::parse($parts[1])->endOfDay();
        } else {
            $carbon_date_from = new Carbon('last Monday');
            $from = $carbon_date_from->startOfDay();
            $carbon_date_to = new Carbon('this Sunday');
            $to = $carbon_date_to->endOfDay();
        }
        
        $time_entries = TimeEntry::with('work_type')
            ->whereBetween('start_time', [$from, $to]);

        if (!empty($r->user_id)) {
            $time_entries->whereHas('created_by', function($q) use ($userId) {
                    $q->where('id', $userId);
            });
<<<<<<< HEAD
        }
        /*
        if (!empty($r->caseload_filter)) {
            $time_entries->where('caseload', '=' , $caseload_filter);
        }
        */
=======
        };   
>>>>>>> 9ecd01e5c1e7e9657d8703cc85bd601bc5387a6b

        $time_entries_work_type = $time_entries->get();

        $work_type_time = [];
        
        foreach ($time_entries_work_type as $time_entry) {
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

        
        $time_entries_populations = $time_entries
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

        $time_entries_caseload = $time_entries
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

        return view('admin.time_reports.index', compact(
            'users',
            'population_type_time',
            'caseload_time',
            'work_type_time',
            'workTypeData',
            'populationTypeData',
            'caseloadTypeData',
            'workTypeLabels',
            'populationTypeLabels',
            'caseloadTypeLabels',
            'workTypeMinutes',
            'populationTypeMinutes',
            'caseloadTypeMinutes'
        ));
    }
}