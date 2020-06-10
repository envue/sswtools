<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           <strong>SSW</strong></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           <strong>SSW</strong>Tools</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" data-toggle="control-sidebar" title="Terms Reference"><i class="fa fa-book"></i></a>
                </li>
                
                <li class="pull-right">
                    <a href="#logout" onclick="$('#logout').submit();">
                        <i class="fa fa-sign-out"></i>
                        <span class="title">@lang('quickadmin.qa_logout')</span>
                    </a>
                </li>
                <!-- Disabled Beamer Notification Trigger
                <li class="beamerTrigger pull-right" style="position: relative">
                    <a href="#" title="Notifications"><i class="fa fa-bell-o"></i></a>
                </li>
                -->
                <li class="pull-right">
                    <a href="#" onclick="convertfox.chat('openNewConversation')" title="Message Us"><strong><i class="fa fa-comments-o"></i></strong></a>
                </li>

            </ul>
        </div>
    </nav>
</header>



