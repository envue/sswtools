<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <!-- Hide convertfox and user guiding widgets -->
    <style> 
        .convertfox-chat, #__userGuiding__Root #reusable-button-wrapper {
                display:none!important;
            }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="beamerTrigger" style="display: none;"></div> <!-- Hide beamer widget on auth pages -->
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