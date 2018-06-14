@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.time-work-types.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.time-work-types.fields.name')</th>
                            <td field-key='name'>{{ $time_work_type->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#time_entries" aria-controls="time_entries" role="tab" data-toggle="tab">Time entries list</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="time_entries">
<table class="table table-bordered table-striped {{ count($time_entries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.time-entries.fields.start-time')</th>
                        <th>@lang('quickadmin.time-entries.fields.end-time')</th>
                        <th>@lang('quickadmin.time-entries.fields.work-type')</th>
                        <th>@lang('quickadmin.time-entries.fields.population-type')</th>
                        <th>@lang('quickadmin.time-entries.fields.caseload')</th>
                        <th>@lang('quickadmin.time-entries.fields.student')</th>
                        <th>@lang('quickadmin.time-entries.fields.description')</th>
                        <th>@lang('quickadmin.time-entries.fields.notes')</th>
                        <th>@lang('quickadmin.time-entries.fields.created-by')</th>
                        <th>@lang('quickadmin.time-entries.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($time_entries) > 0)
            @foreach ($time_entries as $time_entry)
                <tr data-entry-id="{{ $time_entry->id }}">
                    <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                                <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                                <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                                <td field-key='population_type'>{{ $time_entry->population_type }}</td>
                                <td field-key='caseload'>{{ $time_entry->caseload }}</td>
                                <td field-key='student'>
                                    @foreach ($time_entry->student as $singleStudent)
                                        <span class="label label-info label-many">{{ $singleStudent->identifier }}</span>
                                    @endforeach
                                </td>
                                <td field-key='description'>{{ $time_entry->description }}</td>
                                <td field-key='notes'>{!! $time_entry->notes !!}</td>
                                <td field-key='created_by'>{{ $time_entry->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $time_entry->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$time_entry->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$time_entry->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $time_entry->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.time_work_types.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
