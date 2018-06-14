@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.user-profiles.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.user_profiles.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.user-profiles.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('num_schools', trans('quickadmin.user-profiles.fields.num-schools').'', ['class' => 'control-label']) !!}
                    {!! Form::number('num_schools', old('num_schools'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('num_schools'))
                        <p class="help-block">
                            {{ $errors->first('num_schools') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('profile_image', trans('quickadmin.user-profiles.fields.profile-image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('profile_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('profile_image_max_size', 2) !!}
                    {!! Form::hidden('profile_image_max_width', 4096) !!}
                    {!! Form::hidden('profile_image_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('profile_image'))
                        <p class="help-block">
                            {{ $errors->first('profile_image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location_address', trans('quickadmin.user-profiles.fields.location').'', ['class' => 'control-label']) !!}
                    {!! Form::text('location_address', old('location_address'), ['class' => 'form-control map-input', 'id' => 'location-input']) !!}
                    {!! Form::hidden('location_latitude', 0 , ['id' => 'location-latitude']) !!}
                    {!! Form::hidden('location_longitude', 0 , ['id' => 'location-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('location'))
                        <p class="help-block">
                            {{ $errors->first('location') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div id="location-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="location-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="/adminlte/js/mapInput.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>

@stop