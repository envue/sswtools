<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ReportsController extends Controller
{
    public function userSignups()
    {
        $reportTitle = 'User signups';
        $reportLabel = 'COUNT';
        $chartType   = 'line';

        $results = User::get()->sortBy('created_at')->groupBy(function ($entry) {
            if ($entry->created_at instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->created_at)->format('m-Y');
            }

            return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->created_at)->format('m-Y');
        })->map(function ($entries, $group) {
            return $entries->count('id');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

}
