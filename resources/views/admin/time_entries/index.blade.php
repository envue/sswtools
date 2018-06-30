@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.time-entries.title')</h3>
    @can('time_entry_create')
    <p>
        <a href="{{ route('admin.time_entries.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        <!-- Upload CSV >
        @can('user_delete')
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('quickadmin.qa_csvImport')</a>
        @include('csvImport.modal', ['model' => 'TimeEntry'])
        @endcan
        -->
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('time_entry_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('time_entry_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.time-entries.fields.start-time')</th>
                        <th>@lang('quickadmin.time-entries.fields.end-time')</th>
                        <th>@lang('quickadmin.time-entries.fields.work-type')</th>
                        <th>@lang('quickadmin.time-entries.fields.population-type')</th>
                        <th>@lang('quickadmin.time-entries.fields.caseload')</th>
                        @can('student_access')
                        <th>@lang('quickadmin.time-entries.fields.student')</th>
                        @endcan
                        <th>@lang('quickadmin.time-entries.fields.description')</th>
                        <th>@lang('quickadmin.time-entries.fields.notes')</th>
                        @can('user_view')
                        <th>@lang('quickadmin.time-entries.fields.created-by')</th>
                        @endcan
                        @can('user_delete')
                        <th>@lang('quickadmin.time-entries.fields.created-by-team')</th>
                        @endcan
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('time_entry_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.time_entries.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.bAutoWidth = false;
            window.dtDefaultOptions.lengthMenu = [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ];
            window.dtDefaultOptions.pageLength = 25;
            window.dtDefaultOptions.responsive = true;
            window.dtDefaultOptions.order= [[ 1, "desc" ]];
            
            window.dtDefaultOptions.ajax = '{!! route('admin.time_entries.index') !!}';
            window.dtDefaultOptions.columns = [@can('time_entry_delete')
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'work_type.name', name: 'work_type.name'},
                {data: 'population_type', name: 'population_type'},
                {data: 'caseload', name: 'caseload'},
                @can('student_access')
                {data: 'student.identifier', name: 'student.identifier'},
                @endcan
                {data: 'description', name: 'description'},
                {data: 'notes', name: 'notes'},
                @can('user_view')
                {data: 'created_by.name', name: 'created_by.name'},
                @endcan
                @can('user_delete')
                {data: 'created_by_team.name', name: 'created_by_team.name'},
                @endcan
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection