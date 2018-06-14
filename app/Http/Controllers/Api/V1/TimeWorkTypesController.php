<?php

namespace App\Http\Controllers\Api\V1;

use App\TimeWorkType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeWorkTypesRequest;
use App\Http\Requests\Admin\UpdateTimeWorkTypesRequest;
use Yajra\DataTables\DataTables;

class TimeWorkTypesController extends Controller
{
    public function index()
    {
        return TimeWorkType::all();
    }

    public function show($id)
    {
        return TimeWorkType::findOrFail($id);
    }

    public function update(UpdateTimeWorkTypesRequest $request, $id)
    {
        $time_work_type = TimeWorkType::findOrFail($id);
        $time_work_type->update($request->all());
        

        return $time_work_type;
    }

    public function store(StoreTimeWorkTypesRequest $request)
    {
        $time_work_type = TimeWorkType::create($request->all());
        

        return $time_work_type;
    }

    public function destroy($id)
    {
        $time_work_type = TimeWorkType::findOrFail($id);
        $time_work_type->delete();
        return '';
    }
}
