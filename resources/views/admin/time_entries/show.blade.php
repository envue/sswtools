@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.time-entries.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.start-time')</th>
                            <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.end-time')</th>
                            <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.work-type')</th>
                            <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.population-type')</th>
                            <td field-key='population_type'>{{ $time_entry->population_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.caseload')</th>
                            <td field-key='caseload'>{{ $time_entry->caseload }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.student')</th>
                            <td field-key='student'>
                                @foreach ($time_entry->student as $singleStudent)
                                    <span class="label label-info label-many">{{ $singleStudent->identifier }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.description')</th>
                            <td field-key='description'>{{ $time_entry->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.notes')</th>
                            <td field-key='notes'>{!! $time_entry->notes !!}</td>
                        </tr>
                        @can('user_view')
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.created-by')</th>
                            <td field-key='created_by'>{{ $time_entry->created_by->name or '' }}</td>
                        </tr>
                        @endcan
                        @can('user_delete')
                        <tr>
                            <th>@lang('quickadmin.time-entries.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $time_entry->created_by_team->name or '' }}</td>
                        </tr>
                        @endcan
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.time_entries.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
