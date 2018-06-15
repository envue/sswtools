@extends('layouts.auth')

@section('content')
<div class="register-box-body">
    <p class="login-box-msg">Reset your password</p>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @lang('quickadmin.qa_reset_password_woops')
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form role="form" method="POST" action="{{ url('password/reset') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group has-feedback">
            <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input id="password-confirm" type="password" placeholder="Retype password" class="form-control" name="password_confirmation" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-right: 15px;">
                    @lang('quickadmin.qa_reset_password')
            </button>
        </div>
    </form>
</div>
@endsection
