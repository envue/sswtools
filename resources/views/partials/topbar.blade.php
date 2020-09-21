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
                <li>
                    <a href="#" onclick="convertfox.chat('openNewConversation')" title="Message Us"><strong><i class="fa fa-comments-o"></i></strong></a>
                </li>
                <li>
                    <a href="https://app.productstash.io/roadmaps/5f64b87e7be07400294b7958/public#current" target="_blank" title="Public Roadmap"><strong><i class="fa fa-map-o"></i></strong></a>
                </li>
                <!-- Product Stash Notification Trigger -->
                <li id="productstashTrigger">
                    <a href="#" title="Notifications"><i class="fa fa-bell-o"></i></a>
                </li>
                <!-- End Product Stash Notification Trigger -->
                <li>
                    <a href="#logout" onclick="$('#logout').submit();">
                        <i class="fa fa-sign-out"></i>
                        <span class="title">@lang('quickadmin.qa_logout')</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>



