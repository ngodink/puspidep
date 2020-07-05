<?php

use Modules\Web\Http\Middleware\IsAdminMiddleware;
use Modules\Account\Models\UserLog;

Route::domain(config('domain.web'))->name('web::')->group(function() {

    Route::get('/', 'Controller@index')->name('index');
    
    Route::get('/about', 'Controller@about')->name('about');
    
    Route::middleware(['auth', IsAdminMiddleware::class])->group(function() {
    	Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    		// Index
    		Route::redirect('/', '/dashboard')->name("index");
    		// Admin Dashboard
            Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
            // Posts
            Route::put('/posts/{post}/restore', 'PostController@restore')->name('posts.restore');
            Route::delete('/posts/{post}/kill', 'PostController@kill')->name('posts.kill');
            Route::resource('/posts', 'PostController');
            // Comments
            Route::put('/comments/{comment}/approve', 'PostCommentController@approve')->name('comments.approve');
            Route::delete('/comments/{comment}', 'PostCommentController@destroy')->name('comments.destroy');
            // Categories
            Route::resource('/categories', 'CategoryController')->except(['create', 'show']);
            // Users
            Route::put('/users/{user}/repass', 'UserController@repass')->name('users.repass');
            Route::put('/users/{user}/restore', 'UserController@restore')->name('users.restore');
            Route::delete('/users/{user}/kill', 'UserController@kill')->name('users.kill');
            Route::resource('/users', 'UserController');

            Route::get('/logs', function () {
                $logs = UserLog::with('user')->orderByDesc('created_at')->paginate();
                return view('web::admin.logs', compact('logs'));
            })->name('logs');
    	});
    });

    Route::get('/{category}', 'Controller@category')->name('category');
    Route::get('/{category}/{slug}', 'Controller@read')->name('read');
    Route::post('/comments/{post}', 'Controller@comment')->name('comment');
});
