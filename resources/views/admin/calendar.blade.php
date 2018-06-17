@extends('layouts.app')
@inject('request', 'Illuminate\Http\Request')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<h3 class="page-title">Calendar</h3>

<div class="panel panel-default">
    <div id='calendar'></div>
</div>

<!--create new entry modal-->
<div class="modal fade" id="createEvent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['id'=> 'eventNew', 'url'=>'calendar']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New Entry</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('start_time', trans('quickadmin.time-entries.fields.start-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('start_time', old('start_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
            </div>
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('end_time', trans('quickadmin.time-entries.fields.end-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('end_time', old('end_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('end_time'))
                    <p class="help-block">
                        {{ $errors->first('end_time') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('work_type_id', trans('quickadmin.time-entries.fields.work-type').'*', ['class' => 'control-label']) !!}
                {!! Form::select('work_type_id', $work_types, old('work_type_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                @if($errors->has('work_type_id'))
                    <p class="help-block">
                        {{ $errors->first('work_type_id') }}
                    </p>
                @endif
            </div>
        </div>
        <div id= "population_caseload_row" class="row">
            <div class="col-xs-12 col-md-8 form-group">
                {!! Form::label('population_type', trans('quickadmin.time-entries.fields.population-type').'*', ['class' => 'control-label']) !!}
                @if($errors->has('population_type'))
                    <p class="help-block">
                        {{ $errors->first('population_type') }}
                    </p>
                @endif
                <br>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'SPED', false, ['required' => 'required']) !!}
                        Special Ed
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'GenEd', false, ['required' => 'required']) !!}
                        General Ed
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'Mixed', false, ['required' => 'required']) !!}
                        Mixed
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('population_type', 'null', false, ['required' => 'required']) !!}
                    </label>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-4 form-group">
                {!! Form::label('caseload', trans('quickadmin.time-entries.fields.caseload').'*', ['class' => 'control-label']) !!}
                @if($errors->has('caseload'))
                    <p class="help-block">
                        {{ $errors->first('caseload') }}
                    </p>
                @endif
                <br>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'Yes', false, ['required' => 'required']) !!}
                        Yes
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'No', false, ['required' => 'required']) !!}
                        No
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('caseload', 'null', false, ['required' => 'required']) !!}
                    </label>
                </div>
            </div>
        </div>
        <div id="student_row" class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('student', trans('quickadmin.time-entries.fields.student').'', ['class' => 'control-label']) !!}
                <button type="button" class="btn btn-primary btn-xs" id="selectbtn-student">
                    {{ trans('quickadmin.qa_select_all') }}
                </button>
                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-student">
                    {{ trans('quickadmin.qa_deselect_all') }}
                </button>
                {!! Form::select('student[]', $students, old('student'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-student' ]) !!}
                @if($errors->has('student'))
                    <p class="help-block">
                        {{ $errors->first('student') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('description', trans('quickadmin.time-entries.fields.description').'', ['class' => 'control-label']) !!}
                {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Brief description']) !!}
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('notes', trans('quickadmin.time-entries.fields.notes').'', ['class' => 'control-label']) !!}
                {!! Form::textarea('notes', old('notes'), ['class' => 'form-control ', 'placeholder' => 'Brief notes about this entry']) !!}
                @if($errors->has('notes'))
                    <p class="help-block">
                        {{ $errors->first('notes') }}
                    </p>
                @endif
            </div>
        </div>
      </div><!-- /.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary']) !!}
      </div><!-- /.modal-footer -->
    {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--update entry modal-->
<div class="modal fade" id="updateEvent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['id'=> 'eventUpdate', 'url'=>'calendar']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Entry</h4>
      </div>
      <div class="modal-body">
      <input type="text" id="event_id" name="event_id" class="hidden"> <!-- Event id hidden field -->
      <div class="row">
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('start_time', trans('quickadmin.time-entries.fields.start-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('start_time', old('start_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
            </div>
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('end_time', trans('quickadmin.time-entries.fields.end-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('end_time', old('end_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('end_time'))
                    <p class="help-block">
                        {{ $errors->first('end_time') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('work_type_id', trans('quickadmin.time-entries.fields.work-type').'*', ['class' => 'control-label']) !!}
                {!! Form::select('work_type_id', $work_types, old('work_type_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                @if($errors->has('work_type_id'))
                    <p class="help-block">
                        {{ $errors->first('work_type_id') }}
                    </p>
                @endif
            </div>
        </div>
        <div id= "population_caseload_row" class="row">
            <div class="col-xs-12 col-md-8 form-group">
                {!! Form::label('population_type', trans('quickadmin.time-entries.fields.population-type').'*', ['class' => 'control-label']) !!}
                @if($errors->has('population_type'))
                    <p class="help-block">
                        {{ $errors->first('population_type') }}
                    </p>
                @endif
                <br>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'SPED', false, ['required' => 'required']) !!}
                        Special Ed
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'GenEd', false, ['required' => 'required']) !!}
                        General Ed
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('population_type', 'Mixed', false, ['required' => 'required']) !!}
                        Mixed
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('population_type', 0, false, ['required' => 'required']) !!}
                    </label>
                </div>
                
            </div>
        
            <div class="col-xs-12 col-md-4 form-group">
                {!! Form::label('caseload', trans('quickadmin.time-entries.fields.caseload').'*', ['class' => 'control-label']) !!}
                @if($errors->has('caseload'))
                    <p class="help-block">
                        {{ $errors->first('caseload') }}
                    </p>
                @endif
                <br>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'Yes', false, ['required' => 'required']) !!}
                        Yes
                    </label>
                </div>
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'No', false, ['required' => 'required']) !!}
                        No
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('caseload', 0, false, ['required' => 'required']) !!}
                    </label>
                </div>
            </div>
        </div>
        <div id="student_row" class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('student', trans('quickadmin.time-entries.fields.student').'', ['class' => 'control-label']) !!}
                <button type="button" class="btn btn-primary btn-xs" id="selectbtn-student">
                    {{ trans('quickadmin.qa_select_all') }}
                </button>
                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-student">
                    {{ trans('quickadmin.qa_deselect_all') }}
                </button>
                {!! Form::select('student[]', $students, old('student'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-student' ]) !!}
                @if($errors->has('student'))
                    <p class="help-block">
                        {{ $errors->first('student') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('description', trans('quickadmin.time-entries.fields.description').'', ['class' => 'control-label']) !!}
                {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Brief description']) !!}
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('notes', trans('quickadmin.time-entries.fields.notes').'', ['class' => 'control-label']) !!}
                {!! Form::textarea('notes', old('notes'), ['class' => 'form-control ', 'placeholder' => 'Brief notes about this entry']) !!}
                @if($errors->has('notes'))
                    <p class="help-block">
                        {{ $errors->first('notes') }}
                    </p>
                @endif
            </div>
        </div>
      </div><!-- /.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary']) !!}
        {!! Form::button(trans('quickadmin.qa_delete'), ['id' => 'eventDelete', 'class' => 'btn btn-danger']) !!}
      </div><!-- /.modal-footer -->
    {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 
@endsection

@section('javascript')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
            
    <script>
        $('.datetime').datetimepicker({
            format: "{{ config('app.datetime_format_moment') }}",
            locale: "{{ App::getLocale() }}",
            sideBySide: true,
        });
    </script>

    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
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

    <script>
        //script for student select all/deselect all buttons
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
        //script to conditional show/hide fields based on work_type_id
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
            $('input:radio').attr('required', 'required');    
            }
        }).change(); // automatically execute the on change function on page load
    </script>
    
@endsection