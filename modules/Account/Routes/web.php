<?php

Route::prefix('account')->name('account::')->group(function() {
   
    Route::redirect('/login', '/auth/login');

    // Auth
    Route::prefix('auth')->name('auth.')->namespace('Auth')->group(function() {
        Route::redirect('/', '/auth/login');
    	// Guest page
    	Route::middleware('guest')->group(function() {
    		// Login
    		Route::get('/login', 'LoginController@index')->name('login');
    		Route::post('/login', 'LoginController@login')->name('login');
    		// Register
    		Route::get('/register', 'RegisterController@index')->name('register');
    		Route::post('/register', 'RegisterController@register')->name('register');
    		// Forgot
    		Route::get('/forgot', 'ForgotController@index')->name('forgot');
    		Route::post('/forgot', 'ForgotController@send')->name('forgot');
    		// Broker
    		Route::get('/broker', 'BrokerController@index')->name('broker');
    		Route::post('/broker', 'BrokerController@broke')->name('broker');
    	});
    	// Auth page
    	Route::middleware('auth')->group(function() {
            // Logout
            Route::post('/logout', 'LoginController@logout')->name('logout');
    	});
    });

    // Account page
    Route::middleware('auth')->group(function() {
        // My account
        Route::get('/', 'Controller@home')->name('index');
    	// Username
    	Route::get('/username', 'UsernameController@index')->name('username');
    	Route::put('/username', 'UsernameController@update')->name('username');
    	// Password
    	Route::get('/password', 'PasswordController@index')->name('password');
    	Route::put('/password', 'PasswordController@update')->name('password');
    	// User
    	Route::name('user.')->namespace('User')->group(function() {
    		// Profile
    		Route::get('/profile', 'ProfileController@index')->name('profile');
    		Route::put('/profile', 'ProfileController@update')->name('profile');
    		// Email
    		Route::get('/email', 'EmailController@index')->name('email');
    		Route::put('/email', 'EmailController@update')->name('email');
    		Route::get('/email/reverify', 'EmailController@reverify')->name('email.reverify');
    		// Phone
    		Route::get('/phone', 'PhoneController@index')->name('phone');
    		Route::put('/phone', 'PhoneController@update')->name('phone');
    	});
    });

    // Verifying email, without 'auth'
    Route::get('/user/email/verify', 'User\EmailController@verify')->name('user.email.verify');
});
