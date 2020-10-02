@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        @can('user_delete')
                        <tr>
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.team')</th>
                            <td field-key='team'>{{ $user->team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.stripe-customer-id')</th>
                            <td field-key='stripe_customer_id'>{{ $user->stripe_customer_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.role-until')</th>
                            <td field-key='role_until'>{{ $user->role_until }}</td>
                        </tr>
                        @endcan
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">

<li role="presentation" class="active"><a href="#time_entries" aria-controls="time_entries" role="tab" data-toggle="tab">Time entries list</a></li>
<li role="presentation" class=""><a href="#students" aria-controls="students" role="tab" data-toggle="tab">Students</a></li>
@can('payments_access')    
<li role="presentation" class=""><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Payments</a></li>
@endcan
</ul>

<!-- Tab panes -->
<div class="tab-content">
@can('payments_access')    
<div role="tabpanel" class="tab-pane" id="payments">
<table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.payments.fields.user')</th>
                        <th>@lang('quickadmin.payments.fields.role')</th>
                        <th>@lang('quickadmin.payments.fields.payment-amount')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($payments) > 0)
            @foreach ($payments as $payment)
                <tr data-entry-id="{{ $payment->id }}">
                    <td field-key='user'>{{ $payment->user->email or '' }}</td>
                                <td field-key='role'>{{ $payment->role->title or '' }}</td>
                                <td field-key='payment_amount'>{{ $payment->payment_amount }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
@endcan
<div role="tabpanel" class="tab-pane " id="students">
<table class="table table-bordered table-striped {{ count($students) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.students.fields.identifier')</th>
                        <th>@lang('quickadmin.students.fields.created-by')</th>
                        <th>@lang('quickadmin.students.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($students) > 0)
            @foreach ($students as $student)
                <tr data-entry-id="{{ $student->id }}">
                    <td field-key='identifier'>{{ $student->identifier }}</td>
                                <td field-key='created_by'>{{ $student->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $student->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('student_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.students.restore', $student->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('student_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.students.perma_del', $student->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('student_view')
                                    <a href="{{ route('admin.students.show',[$student->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('student_edit')
                                    <a href="{{ route('admin.students.edit',[$student->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('student_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.students.destroy', $student->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane active" id="time_entries">
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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