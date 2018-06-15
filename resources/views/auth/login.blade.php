@extends('layouts.auth')

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> @lang('quickadmin.qa_there_were_problems_with_input'):
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form role="form" method="POST" action="{{ url('login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="{{ route('auth.login.social', 'facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="{{ route('auth.login.social', 'google') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google"></i> Sign in using
        Google</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ route('auth.password.reset') }}">I forgot my password</a><br>
    <a href="{{ route('auth.register') }}" class="text-center">Register a new account</a>
</div>
  <!-- /.login-box-body -->
@endsection
