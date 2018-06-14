<?php

namespace App\Http\Controllers\Api\V1;

use App\TimeEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeEntriesRequest;
use App\Http\Requests\Admin\UpdateTimeEntriesRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class TimeEntriesController extends Controller
{
    public function index()
    {
        return TimeEntry::all();
    }

    public function show($id)
    {
        return TimeEntry::findOrFail($id);
    }

    public function update(UpdateTimeEntriesRequest $request, $id)
    {
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->update($request->all());
        

        return $time_entry;
    }

    public function store(StoreTimeEntriesRequest $request)
    {
        $time_entry = TimeEntry::create($request->all());
        

        return $time_entry;
    }

    public function destroy($id)
    {
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->delete();
        return '';
    }
}
