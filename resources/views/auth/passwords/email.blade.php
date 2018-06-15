@extends('layouts.auth')

@section('content')
<div class="register-box-body">
    <p class="login-box-msg">Send a link to your email to reset your password</p>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were problems with input:
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form role="form" method="POST" action="{{ url('password/email') }}">
        <input type="hidden" name="_token"value="{{ csrf_token() }}">

        <div class="form-group has-feeback">
            <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-right: 15px;">
                Reset password
            </button>
        </div>
    </form>
</div>
@endsection