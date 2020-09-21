<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SSW</b>Tools</a>
        </div>
        <!-- /.login-logo -->
            @yield ('content')
    </div> 
    
    @include('partials.javascripts')
</body>
</html>