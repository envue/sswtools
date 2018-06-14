<?php

namespace App\Http\Controllers\Api\V1;

use App\TimeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeProjectsRequest;
use App\Http\Requests\Admin\UpdateTimeProjectsRequest;
use Yajra\DataTables\DataTables;

class TimeProjectsController extends Controller
{
    public function index()
    {
        return TimeProject::all();
    }

    public function show($id)
    {
        return TimeProject::findOrFail($id);
    }

    public function update(UpdateTimeProjectsRequest $request, $id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->update($request->all());
        

        return $time_project;
    }

    public function store(StoreTimeProjectsRequest $request)
    {
        $time_project = TimeProject::create($request->all());
        

        return $time_project;
    }

    public function destroy($id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->delete();
        return '';
    }
}
