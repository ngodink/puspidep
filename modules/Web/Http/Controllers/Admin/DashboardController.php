<?php

namespace Modules\Web\Http\Controllers\Admin;

use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogCategory;
use Modules\Web\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
    	$categories = BlogCategory::withCount('posts')->get();

    	$recent_posts = BlogPost::orderByDesc('created_at')->limit(5)->get();
    	$most_viewed_posts = BlogPost::where('views_count', '>', '0')->orderByDesc('views_count')->limit(5)->get();

        return view('web::admin.dashboard', compact('categories', 'recent_posts', 'most_viewed_posts'));
    }
}
