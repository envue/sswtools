<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: Subscriptions
        Gate::define('subscription_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Students
        Gate::define('student_access', function ($user) {
            return in_array($user->role_id, [1, 8, 9]);
        });
        Gate::define('student_create', function ($user) {
            return in_array($user->role_id, [1, 8, 9]);
        });
        Gate::define('student_edit', function ($user) {
            return in_array($user->role_id, [1, 8, 9]);
        });
        Gate::define('student_view', function ($user) {
            return in_array($user->role_id, [1, 8, 9]);
        });
        Gate::define('student_delete', function ($user) {
            return in_array($user->role_id, [1, 8, 9]);
        });

        // Auth gates for: Payments
        Gate::define('payment_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Time entries
        Gate::define('time_entry_access', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });
        Gate::define('time_entry_create', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });
        Gate::define('time_entry_edit', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });
        Gate::define('time_entry_view', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });
        Gate::define('time_entry_delete', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });

        // Auth gates for: Reports
        Gate::define('report_access', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });

        // Auth gates for: Time management
        Gate::define('time_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Time reports
        Gate::define('time_report_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 5, 9]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 5, 9]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Teams
        Gate::define('team_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('team_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('team_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('team_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('team_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Content management
        Gate::define('content_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Content categories
        Gate::define('content_category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_category_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Content tags
        Gate::define('content_tag_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('content_tag_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('content_tag_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('content_tag_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('content_tag_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Content pages
        Gate::define('content_page_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_page_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_page_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('content_page_view', function ($user) {
            return in_array($user->role_id, [1, 5, 6, 8, 9]);
        });
        Gate::define('content_page_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: System admin
        Gate::define('system_admin_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Time work types
        Gate::define('time_work_type_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_work_type_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_work_type_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_work_type_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_work_type_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Time projects
        Gate::define('time_project_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_project_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_project_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_project_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('time_project_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: User profiles
        Gate::define('user_profile_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_profile_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_profile_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_profile_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_profile_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
