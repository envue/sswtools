@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.time-entries.title')</h3>
    
    {!! Form::model($time_entry, ['method' => 'PUT', 'route' => ['admin.time_entries.update', $time_entry->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
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
            <div id= "population_row" class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('population_type', trans('quickadmin.time-entries.fields.population-type').': ', ['class' => 'control-label']) !!}
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
                            {!! Form::radio('population_type', '504', false, ['required' => 'required']) !!}
                            504
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
                            {!! Form::radio('population_type', '0', false, ['required' => 'required']) !!}
                        </label>
                    </div>
                </div>
            </div>
            <div id="caseload_row" class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('caseload', trans('quickadmin.time-entries.fields.caseload').': ', ['class' => 'control-label']) !!}
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
                    <div class= "radio-inline">
                        <label>
                            {!! Form::radio('caseload', 'Mixed', false, ['required' => 'required']) !!}
                            No
                        </label>
                    </div>
                    <div class= "hidden">
                        <label>
                            {!! Form::radio('caseload', '0', false, ['required' => 'required']) !!}
                        </label>
                    </div>
                </div>
            </div>
            @can('student_access')
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
            </div>@endcan
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
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
    <script>
        $("#selectbtn-student").click(function(){
            $("#selectall-student > option").prop("selected","selected");
            $("#selectall-student").trigger("change");
        });
        $("#deselectbtn-student").click(function(){
            $("#selectall-student > option").prop("selected","");
            $("#selectall-student").trigger("change");
        });
    </script>
    @include('partials.timeEntryConditionals')
@stop