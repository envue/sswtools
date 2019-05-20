@extends('layouts.app')

@php
        $content1 = 'https://schoolsocialwork.net/feed/';
        $articles = simplexml_load_file($content1);     
@endphp

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
    <style>
        @media (max-width:767px){
            .home-widget {
                font-size: 20px!important;
            }
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <h3> Dashboard </h3>
    
    <div class="row">
        @can('student_access')
        <div class="col-md-3 col-xs-6">
        @endcan
        @cannot('student_access')
        <div class="col-md-4 col-xs-6">
        @endcannot
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h2 class=home-widget><strong>Calendar</strong></h2>
                <p>
                Create/edit time entires
                </p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="{{url('admin/calendar')}}" class="small-box-footer">View Calendar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @can('student_access')
        <div class="col-md-3 col-xs-6">
        @endcan
        @cannot('student_access')
        <div class="col-md-4 col-xs-6">
        @endcannot
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
             <h2 class=home-widget><strong>Time Report</strong></h2>
                <p>
                Generate time reports
                </p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="{{ route('admin.time_reports.index') }}" class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @can('student_access')
        <div class="col-md-3 col-xs-6">
        @endcan
        @cannot('student_access')
        <div class="col-md-4 col-xs-6">
        @endcannot
          <!-- small box -->
          <div class="small-box bg-aqua-active">
            <div class="inner">
              <h2 class=home-widget><strong>Time Table</strong></h2>
                <p>
                Search and export time entires
                </p>
            </div>
            <div class="icon">
              <i class="fa fa-table"></i>
            </div>
            <a href="{{ route('admin.time_entries.index') }}" class="small-box-footer">View Time Table <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @can('student_access')
        <div class="col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h2 class=home-widget><strong>Students</strong></h2>
                <p>
                Add/edit students for time entries
                </p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="{{ route('admin.students.index') }}" class="small-box-footer">View Students <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endcan
    </div>    
    
    <div class="row">
        <div class = "col-sm-12 col-md-4">
            <!-- Quick Add Calendar -->                            
            <div class="box box-default">
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
         </div>  
        <!-- /.column -->
        <div class = "col-sm-12 col-md-4">    
            <!-- Worktype Chart -->
            <div class="box box-default">
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
                    <canvas id="worktypeChart"></canvas>
                </div>
            </div>
            <!-- /.box -->
            
            <!-- Recent Time Entries Table -->
            <div class="box box-default">
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
                            <th> @lang('quickadmin.time-entries.fields.work-type')</th>
                             
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($timeentries as $timeentry)
                            <tr> 
                                <td>{{ $timeentry->start_time }} </td> 
                                <td>{{ $timeentry->work_type->name }} </td>
                                 
                                <td>
                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$timeentry->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
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

        <div class = "col-sm-12 col-md-4">
            <div class="box box-default">
            <div class="box-header with-border">
            <i class="fa fa-wordpress"></i>
              <h3 class="box-title">Latest Blog Posts</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <a class="btn btn-box-tool" href="https://schoolsocialwork.net" target="_blank">View All</a>
                    </div>
                    <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($articles->channel->item as $item) 
                <li class="item">
                  <div class="product-img">
                    <img src="{{$item->children( 'media', True )->content->attributes()['url']}}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="{{$item->link}}" class="product-title" target="_blank" >{{$item->title}}</a>
                    <span class="product-description">
                          {{html_entity_decode($item->description)}}
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-scroll/1.3.2/slimscroll.min.js"></script>

<script>
// Datatables.net options for student data table
$('#students_table').DataTable({
    'buttons': [  ],
});
</script>

<script>
$(document).ready(function(){

    // Send user data to Gist
    gist.identify("{!! $userID !!}", {
        email: "{!! $userEmail !!}",
        name: "{!! $userName !!}",
        role: "{!! $userRole !!}",
        team: "{!! $userTeam !!}",
        last_app_use: {!! time() !!},
        time_entries: {!! count($timeEntriesAll) !!}
    });
    
    // Full calendar JS and Options
    var scrollTime = moment().format("HH") + ":00:00";

    $('#calendar').fullCalendar({
        eventSources: [
            '{{ URL::route('admin.calendar.getevents') }}',   
        ],
        // calendar options and callbacks here
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
        height: 500,
        eventOverlap: false,
        nowIndicator: true,
        scrollTime: scrollTime,

        // When calendar event is clicked
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
        },
        
        // When calendar event is dropped to new location
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
                url: 'admin/calendar/' + calEvent.id,
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

        // When calendar event is resized
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
                url: 'admin/calendar/' + calEvent.id,
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

        //When time slot is selected by clicking and dragging
        select: function(start, end) {
            var startDate = moment(start).format('MM/DD/YYYY hh:mm A');
            var endDate = moment(end).format('MM/DD/YYYY hh:mm A');
            $('#createEvent').modal();
            $('#eventNew').trigger("reset");
            $('#work_type_id, #selectall-student').change();
            $(".modal-body #start_time").val(startDate);
            $(".modal-body #end_time").val(endDate);
        }
    });
    // end of full calendar script and options

    /***********************************************************************
    The following scripts control the behavior of the time entry modal forms
    ************************************************************************/

    // Bootstrap datetime picker settings
    $('.datetime').datetimepicker({
    format: "{{ config('app.datetime_format_moment') }}",
    locale: "{{ App::getLocale() }}",
    sideBySide: true,
    ignoreReadonly: true,
    allowInputToggle: true,
    widgetPositioning:{
        horizontal: 'auto',
        vertical: 'bottom'
        }
    });
    
    //Ajax to add new event to calendar and database
    $('#eventNew').on('submit',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault(e);

        $.ajax({
            type:"POST",
            url:'admin/calendar',
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

    //Ajax to update event on calendar and database.
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
            url:'admin/calendar/form_update/' + id,
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

    //Ajax to delete event on calendar and database.
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
                url:'admin/calendar/' + id,
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

    // Script for the selectAll and deselectAll buttons on the time entries modal forms
    $("#eventNew #selectbtn-student, #eventUpdate #selectbtn-student").click(function(){
        $("#eventNew #selectall-student > option, #eventUpdate #selectall-student > option").prop("selected","selected");
        $("#eventNew #selectall-student, #eventUpdate #selectall-student").trigger("change");
    });
    $("#eventNew #deselectbtn-student, #eventUpdate #deselectbtn-student").click(function(){
        $("#eventNew #selectall-student > option, #eventUpdate #selectall-student > option").prop("selected","");
        $("#eventNew #selectall-student, #eventUpdate #selectall-student").trigger("change");
    });

    //Conditionally show/hide fields based on work_type_id
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
});
</script>

<!-- Chartjs scripts for graphs -->
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
                display: false,
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
@endsection