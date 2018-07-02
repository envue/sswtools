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
                {!! Form::text('start_time', old('start_time'), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
            </div>
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('end_time', trans('quickadmin.time-entries.fields.end-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('end_time', old('end_time'), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
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
                {!! Form::select('work_type_id', $work_types, old('work_type_id'), ['class' => 'form-control select2', 'required' => ''], $work_types_descriptions) !!}
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
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'Mixed', false, ['required' => 'required']) !!}
                        Mixed
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('caseload', 'null', false, ['required' => 'required']) !!}
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
      </div><!-- /.modal-body -->
      <div class="modal-footer">
        {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary pull-left']) !!}
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
                {!! Form::text('start_time', old('start_time'), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
            </div>
            <div class="col-xs-12 col-md-6 form-group">
                {!! Form::label('end_time', trans('quickadmin.time-entries.fields.end-time').'*', ['class' => 'control-label']) !!}
                {!! Form::text('end_time', old('end_time'), ['readonly'=>'true','onkeydown'=>'return false', 'class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
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
                {!! Form::select('work_type_id', $work_types, old('work_type_id'), ['class' => 'form-control select2', 'required' => ''], $work_types_descriptions) !!}
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
                <div class= "radio-inline">
                    <label>
                        {!! Form::radio('caseload', 'Mixed', false, ['required' => 'required']) !!}
                        Mixed
                    </label>
                </div>
                <div class= "hidden">
                    <label>
                        {!! Form::radio('caseload', 0, false, ['required' => 'required']) !!}
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
      </div><!-- /.modal-body -->
      <div class="modal-footer">
        {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary pull-left']) !!}
        {!! Form::button(trans('quickadmin.qa_delete'), ['id' => 'eventDelete', 'class' => 'btn btn-danger pull-left']) !!}
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div><!-- /.modal-footer -->
    {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
