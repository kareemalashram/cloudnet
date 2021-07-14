<?php




Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'role:super_admin|admin'])
    ->group(function (){


    // dashboard

        Route::get('/home','DashboardController@index')->name('home');

    // category routes

        Route::resource('categories','CategoryController')->except(['show']);

        // Movies routes

        Route::resource('movies','MovieController');

    // category Role

        Route::resource('roles','RoleController')->except(['show']);


        // users routes

        Route::resource('users','UserController')->except(['show']);

        // settings routes

        Route::get('/settings/social_login','SettingController@social_login')->name('settings.social_login');
        Route::get('/settings/social_links','SettingController@social_links')->name('settings.social_links');
        Route::post('/settings','SettingController@store')->name('settings.store');


    });





