@extends('layouts.app')
@inject('request', 'Illuminate\Http\Request')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>

<meta name="csrf-token" content="{{ csrf_token() }}"> 
<h3 class="page-title">Calendar</h3>

<div class="panel panel-default">
    <div id='calendar'></div>
</div>

@include('partials.timeEntryModals')
 
@endsection

@section('javascript')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            // Full calendar JS and Options
            var scrollTime = moment().format("HH") + ":00:00";

            $('#calendar').fullCalendar({
                eventSources: [
                    '{{ URL::route('admin.calendar.getevents') }}',   
                ],
                // put your options and callbacks here
                header: {
                    right: 'prev,next today',
                    center: 'title',
                    left: 'month,agendaWeek,agendaDay',
                },
                defaultView: 'agendaWeek',
                allDaySlot: false,
                minTime: "06:00:00",
                selectable: true,
                selectHelper: true,
                selectOverlap: false,
                editable: true,
                slotDuration: '00:15:00',
                height: 800,
                eventOverlap: false,

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

                //When time slot is selected by clicking and dragging
                select: function(start, end) {
                    var startDate = moment(start).format('MM/DD/YYYY hh:mm A');
                    var endDate = moment(end).format('MM/DD/YYYY hh:mm A');
                    $('#createEvent').modal();
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
@endsection