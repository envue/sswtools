@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added timeentries</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr> 
                            <th> @lang('quickadmin.time-entries.fields.start-time')</th> 
                            <th> @lang('quickadmin.time-entries.fields.end-time')</th> 
                            <th> @lang('quickadmin.time-entries.fields.work-type')</th> 
                             
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($timeentries as $timeentry)
                            <tr> 
                                <td>{{ $timeentry->start_time }} </td> 
                                <td>{{ $timeentry->end_time }} </td> 
                                <td>{{ $timeentry->work_type->name }} </td> 
                                <td>

                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$timeentry->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan

                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$timeentry->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan

                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $timeentry->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

@section ('javascript')
<script>
    var userID = {!! $currentUserID !!};
    var userEmail = {!! $currentUserEmail !!};
    convertfox.identify("userID", {
        "email": "userEmail",
    });
</script>
@stop

