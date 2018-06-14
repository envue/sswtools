<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('time_entries', 'TimeEntriesController', ['except' => ['create', 'edit']]);

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('content_pages', 'ContentPagesController', ['except' => ['create', 'edit']]);

        Route::resource('time_work_types', 'TimeWorkTypesController', ['except' => ['create', 'edit']]);

        Route::resource('time_projects', 'TimeProjectsController', ['except' => ['create', 'edit']]);

});
