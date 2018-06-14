@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.user-profiles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.user-profiles.fields.title')</th>
                            <td field-key='title'>{{ $user_profile->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.user-profiles.fields.num-schools')</th>
                            <td field-key='num_schools'>{{ $user_profile->num_schools }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.user-profiles.fields.profile-image')</th>
                            <td field-key='profile_image'>@if($user_profile->profile_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user_profile->profile_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user_profile->profile_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.user-profiles.fields.location')</th>
                            <td field-key='location'>{{ $user_profile->location_address }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.user_profiles.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
