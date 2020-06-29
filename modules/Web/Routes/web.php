<?php

Route::domain(config('domain.web'))->name('web::')->group(function() {

    Route::get('/', 'Controller@index')->name('index');
    
    Route::get('/about', 'Controller@about')->name('about');
    
    Route::middleware('auth')->group(function() {
    	Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    		// Index
    		Route::redirect('/', '/dashboard')->name("index");
    		// Admin Dashboard
            Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
            // Posts
            Route::put('/posts/{post}/restore', 'PostController@restore')->name('posts.restore');
            Route::delete('/posts/{post}/kill', 'PostController@kill')->name('posts.kill');
            Route::resource('/posts', 'PostController');
    	});
    });

    Route::get('/{category}', 'Controller@category')->name('category');
    Route::get('/{category}/{slug}', 'Controller@read')->name('read');
});
