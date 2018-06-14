@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.students.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.students.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('identifier', trans('quickadmin.students.fields.identifier').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('identifier', old('identifier'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block">Please consult with your district's FERPA policy before using personally identifiable information such as full name, date of birth, or school id number.</p>
                    @if($errors->has('identifier'))
                        <p class="help-block">
                            {{ $errors->first('identifier') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

