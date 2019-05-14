@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="https://secure.gravatar.com/avatar/f76edb7eda7cdc05c4215023d294ce9d?s=50&d=mm&r=pg" class="img-circle" alt="User Image">

            </div>
            <div class="pull-left info">
            <p style="margin-bottom: 3px;">{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-user"></i> {{ Auth::user()->role->title }}</a> <br>
            @if(isset(Auth::user()->team->name))
            <a href="#"><i class="fa fa-users"></i> {{ Auth::user()->team->name }}</a>
            @endif
            </div>
        </div>
        
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            <li>
                <a href="{{url('admin/calendar')}}">
                  <i class="fa fa-calendar"></i>
                  <span class="title">
                    My Calendar
                  </span>
                </a>
            </li>

            @can('user_access')
            <li>
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Team members</span>
                </a>
            </li>@endcan
                
            @can('student_access')
            <li>
                <a href="{{ route('admin.students.index') }}">
                    <i class="fa fa-graduation-cap"></i>
                    <span>@lang('quickadmin.students.title')</span>
                </a>
            </li>@endcan
            
            @can('time_entry_access')
            <li>
                <a href="{{ route('admin.time_entries.index') }}">
                    <i class="fa fa-table"></i>
                    <span>@lang('quickadmin.time-entries.title')</span>
                </a>
            </li>@endcan
                      
            @can('report_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>@lang('quickadmin.reports.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.time_reports.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span>Time Overview</span>
                        </a>
                    </li>
                    @can('student_access')
                    <li>
                        <a href="{{ route('admin.time_reports_student.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span>Student Report</span>
                        </a>
                    </li>@endcan
                    @can('user_delete')
                    <li>
                        <a href="{{ route('admin.time_reports_long.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span>Team Member Report</span>
                        </a>
                    </li>@endcan 
                </ul>
            </li>@endcan
            
            
            @can('system_admin_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.system-admin.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                     @can('user_management_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>@lang('quickadmin.user-management.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('user_access')
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fa fa-user"></i>
                                    <span>@lang('quickadmin.users.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('team_access')
                            <li>
                                <a href="{{ route('admin.teams.index') }}">
                                    <i class="fa fa-users"></i>
                                    <span>@lang('quickadmin.teams.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('role_access')
                            <li>
                                <a href="{{ route('admin.roles.index') }}">
                                    <i class="fa fa-briefcase"></i>
                                    <span>@lang('quickadmin.roles.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('user_profile_access')
                            <li>
                                <a href="{{ route('admin.user_profiles.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('quickadmin.user-profiles.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('content_management_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>@lang('quickadmin.content-management.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('content_category_access')
                            <li>
                                <a href="{{ route('admin.content_categories.index') }}">
                                    <i class="fa fa-folder"></i>
                                    <span>@lang('quickadmin.content-categories.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('content_tag_access')
                            <li>
                                <a href="{{ route('admin.content_tags.index') }}">
                                    <i class="fa fa-tags"></i>
                                    <span>@lang('quickadmin.content-tags.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('content_page_access')
                            <li>
                                <a href="{{ route('admin.content_pages.index') }}">
                                    <i class="fa fa-file-o"></i>
                                    <span>@lang('quickadmin.content-pages.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('time_work_type_access')
                            <li>
                                <a href="{{ route('admin.time_work_types.index') }}">
                                    <i class="fa fa-th"></i>
                                    <span>@lang('quickadmin.time-work-types.title')</span>
                                </a>
                            </li>@endcan
                        </ul>
                    </li>@endcan
                    
                    @can('system_admin_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Generated Reports</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                        <li class="{{ $request->is('/reports/user-signups') }}">
                                <a href="{{ url('/admin/reports/user-signups') }}">
                                    <i class="fa fa-line-chart"></i>
                                    <span class="title">User signups</span>
                                </a>
                            </li>
                        </ul>
                    </li>@endcan

                    @can('payment_access')
                    <li>
                        <a href="{{ route('admin.payments.index') }}">
                            <i class="fa fa-credit-card"></i>
                            <span>@lang('quickadmin.payments.title')</span>
                        </a>
                    </li>@endcan
  
                </ul>
            </li>@endcan
            
            @can('subscription_access')
            <li>
                <a href="{{ route('admin.subscriptions.index') }}">
                    <i class="fa fa-credit-card"></i>
                    <span>@lang('quickadmin.subscriptions.title')</span>
                </a>
            </li>@endcan
            

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>



