@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
    <style>
        .fc-today{
            background-color:inherit !important;
            }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control { 
            background-color: #fff !important; opacity: 1; 
            }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <h3> Dashboard <small>Control panel</small> </h3>

    <div class="row-eq-height">
        <div class = "col-sm-12 col-md-12">        
            <div class="callout callout-info">
                <h4>Welcome to SSW Tools Beta</h4>
                <p>
                So glad to have you join us! Please note that this is a beta version of the app which is still undergoing extensive development and final testing before its official release.
                </p>
                <p>
                Should you encounter any bugs, glitches, lack of functionality or other problems on the website, please let us know immediately so we can rectify these accordingly. Your particpation and feedback in Beta testing is highly appreciated.
                </p>
                <a href="#" class="callout-footer" onclick="convertfox.chat('openNewConversation')"><i class="fa fa-bug"></i>  Report Bug/Issue</a>
                &nbsp;&nbsp;&nbsp;
                <a href="https://feedback.feedier.com/hrR2TA?email={{ Auth::user()->email }}" class="callout-footer" target="_blank">
                <i class="fa fa-arrow-circle-right"></i>  Feedback Survey</a>
            </div>
        </div>
    </div>    
    
    <div class="row">
        <div class = "col-sm-12 col-md-4">
            <!-- Quick Add Calendar -->                            
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Quick Add Entry</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <a class="btn btn-box-tool" href="{{url('admin/calendar')}}">View Calendar</a>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id='calendar'></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            
            @can('student_access')
            <!-- Student List Table -->
            <div class="box box-warning">
                <div class="box-header with-border">
                <i class="fa fa-table"></i>
                    <h3 class="box-title">My Students</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!--span class="label label-primary">Last 30 Days</span>-->
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="students_table" class="table table-bordered table-striped {{ count($students) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>@lang('quickadmin.students.fields.identifier')</th>
                                            
                                @if( request('show_deleted') == 1 )
                                <th>&nbsp;</th>
                                @else
                                <th>&nbsp;</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($students_list) > 0)
                                @foreach ($students_list as $student)
                                    <tr data-entry-id="{{ $student->id }}">
                                        <td field-key='identifier'>{{ $student->identifier }}</td>
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
            </div>
            @endcan   
        </div>
        <!-- /.column -->
        <div class = "col-sm-12 col-md-8">
            
            <!-- Worktype Chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart"></i>
                    <h3 class="box-title">Time Overview <small> (Last 30 days)</small></h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!--span class="label label-primary">Last 30 Days</span>-->
                    <a class="btn btn-box-tool" href="{{url('admin/time_reports')}}">Full Report</a>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="worktypeChart" </canvas>
                </div>
            </div>
            <!-- /.box -->
            
            <!-- Recent Time Entries Table -->
            <div class="box box-info">
                <div class="box-header with-border">
                <i class="fa fa-table"></i>
                    <h3 class="box-title">Recent Time Entries</h3>
                    <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!--span class="label label-primary">Last 30 Days</span>-->
                    <a class="btn btn-box-tool" href="{{url('admin/time_entries')}}">View All</a>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
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
            <!-- /. Recent time entries table -->
        </div>
        <!-- /. Column -->
    </div>
    <!-- /.row -->
@include('partials.timeEntryModals')
@endsection

@section ('javascript')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
<!-- <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<!-- Send user data to Convertfox -->
<script>
$(document).ready(function(){
    convertfox.identify("{!! $userID !!}", {
        email: "{!! $userEmail !!}",
        name: "{!! $userName !!}",
        role: "{!! $userRole !!}",
        team: "{!! $userTeam !!}"
    });
});    
</script>

<!--Datatables options -->
<script>
        $('#students_table').DataTable( {
            'buttons': [  ],
        } );
</script>

<!-- tooltip script -->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>

<!-- Chartjs script -->
<script>
    var workTypeData = {!! json_encode($workTypeData)  !!};
    var workTypeLabels = {!! json_encode($workTypeLabels)  !!};
    
    var ctx = document.getElementById("worktypeChart").getContext('2d');
    var workTypeChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: workTypeLabels,
            datasets: [{
                label: '# of Minutes',
                data: workTypeData,
                backgroundColor: [
                    '#3c8dbc',
                    '#dd4b39',
                    '#00a65a',
                    '#00c0ef',
                    '#f39c12',
                    '#0073b7',
                    '#001F3F',
                    '#39CCCC',
                    '#3D9970',
                    '#01FF70',
                    '#FF851B',
                    '#F012BE',
                    '#605ca8',
                    '#D81B60',
                    '#111',
                    '#d2d6de'   
                ],
                
                borderWidth: 3
            }]
        },
        options: {                
            
            legend: {
                display: true,
                position: 'right',
                labels: {
                boxWidth: 10,
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                        var total = meta.total;
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                        return currentValue + ' (' + percentage + '%)';
                    },
                    title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    }
                }
            }, 
        }
    });
</script>


<!-- time picker settings -->            
<script>
    $('.datetime').datetimepicker({
        format: "{{ config('app.datetime_format_moment') }}",
        locale: "{{ App::getLocale() }}",
        sideBySide: true,
        ignoreReadonly: true,
        allowInputToggle: true,
        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });
</script>

<!-- Full Calendar init and options -->
<script>
    $(document).ready(function () {
        var scrollTime = moment().format("HH") + ":00:00";
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            eventSources: [
                '{{ URL::route('admin.calendar.getevents') }}',   
            ],
            // put your options and callbacks here
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            defaultView: 'agendaDay',
            allDaySlot: false,
            minTime: "06:00:00",
            selectable: true,
            selectHelper: true,
            selectOverlap: false,
            editable: true,
            slotDuration: '00:15:00',
            height: 425,
            eventOverlap: false,
            nowIndicator: true,
            scrollTime: scrollTime,
            
            eventClick: function(calEvent, jsEvent, view) {
                var startDate = moment(calEvent.start).format('MM/DD/YYYY hh:mm A');
                var endDate = moment(calEvent.end).format('MM/DD/YYYY hh:mm A');
                
                $('#updateEvent').modal();
                
                $('#updateEvent #event_id').val(calEvent.id);
                $('#updateEvent #work_type_id').val(calEvent.work_type).change();
                $('#updateEvent input[name=caseload][value=' + calEvent.caseload + ']').prop('checked',true);
                $('#updateEvent input[name=population_type][value=' + calEvent.population_type + ']').prop('checked',true);
                $('#updateEvent #description').val(calEvent.description);
                $('#updateEvent #start_time').val(startDate);
                $('#updateEvent #end_time').val(endDate);
                $('#updateEvent #notes').val(calEvent.notes);
                $('#updateEvent #selectall-student').val(calEvent.student).change();
                //$("#updateEvent #selectall-student > option[value=]").prop("selected", "selected").change();
            },
            
            eventDrop: function(calEvent, delta, revertFunc) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var startDate = moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss');
                var endDate = moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    type:'POST',
                    url: 'calendar/' + calEvent.id,
                    dataType:"json",
                    data: {
                        _method : "PATCH",
                        'start_time': startDate,
                        'end_time': endDate,   
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
            },

            eventResize: function(calEvent, delta, revertFunc) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var startDate = moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss');
                var endDate = moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    type:'POST',
                    url: 'calendar/' + calEvent.id,
                    dataType:"json",
                    data: {
                        _method : "PATCH",
                        'start_time': startDate,
                        'end_time': endDate,    
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
            }, 
            
            select: function(start, end) {
                var startDate = moment(start).format('MM/DD/YYYY hh:mm A');
                var endDate = moment(end).format('MM/DD/YYYY hh:mm A');
                $('#createEvent').modal();
                $(".modal-body #start_time").val(startDate);
                $(".modal-body #end_time").val(endDate);
            }
        });
        
        //Ajax call to add new event to calendar
        $('#eventNew').on('submit',function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);

            $.ajax({
                type:"POST",
                url:'calendar',
                data:$(this).serialize(),
                dataType: 'json',
                success: function(text){
                    $("#createEvent").modal('hide');
                    $('#calendar').fullCalendar( 'refetchEvents' );
                },
                error: function(data){
                }
            })
        });

        //Ajax call to update event on calendar.
        $('#eventUpdate').on('submit',function(e){
            id = $("#event_id").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);

            $.ajax({
                type:"PUT",
                url:'calendar/form_update/' + id,
                data:$(this).serialize(),
                dataType: 'json',
                success: function(text){
                    $("#updateEvent").modal('hide');
                    $('#calendar').fullCalendar( 'refetchEvents' );

                },
                error: function(data){
                }
            })
        });

        //Ajax call to delete event on calendar.
        $('#eventUpdate').on('click','#eventDelete',function(e){
            id = $("#event_id").val()
            didConfirm = confirm("Are you sure you want to permanently delete this entry?")
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);
            
            if(didConfirm){
                $.ajax({
                    type:"DELETE",
                    url:'calendar/' + id,
                    data:$(this).serialize(),
                    dataType: 'json',
                    success: function(text){
                        $("#updateEvent").modal('hide');
                        $('#calendar').fullCalendar( 'refetchEvents' );
                    },
                    error: function(data){
                    }
                })
            }
        });
    });
</script>

<!-- script for student select all/deselect all buttons -->
<script>
    $("#eventNew #selectbtn-student, #eventUpdate #selectbtn-student").click(function(){
        $("#eventNew #selectall-student > option, #eventUpdate #selectall-student > option").prop("selected","selected");
        $("#eventNew #selectall-student, #eventUpdate #selectall-student").trigger("change");
    });
    $("#eventNew #deselectbtn-student, #eventUpdate #deselectbtn-student").click(function(){
        $("#eventNew #selectall-student > option, #eventUpdate #selectall-student > option").prop("selected","");
        $("#eventNew #selectall-student, #eventUpdate #selectall-student").trigger("change");
    });
</script>

<script>
        //conditionally show/hide fields based on work_type_id
        $('#eventNew #work_type_id, #eventUpdate #work_type_id').change(function () {
        var val = $(this).val();

            if (val > 12) {
            //hide options
            $('#eventNew #population_caseload_row, #eventUpdate #population_caseload_row').hide();
            $('#eventNew #student_row, #eventUpdate #student_row').hide();
            //deselect options on hide
            $("#eventNew #selectall-student > option, #eventUpdate #selectall-student > option").prop("selected","");
            $("#eventNew #selectall-student, #eventUpdate #selectall-student").trigger("change");
            $('#eventNew input:radio').removeAttr('checked');
            //unrequire hidden radio fields
            $('input:radio').removeAttr('required');
            //select null value on update form when non-caseload/population work_type_id is selected
            $('#updateEvent input[name=caseload][value=' + 0 + ']').prop('checked',true);
            $('#updateEvent input[name=population_type][value=' + 0 + ']').prop('checked',true);

            }
            else {
            $('#eventNew #population_caseload_row, #eventUpdate #population_caseload_row').show();
            $("#eventNew #student_row, #eventUpdate #student_row").show();
            //require visible radio fields
            $('input:radio').attr('required', true);
            $('input:radio').removeAttr('checked');    
            }
        }).change(); // automatically execute the on change function on page load
    </script>
@stop

