<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogCategory;
use App\Http\Controllers\Controller as AppController;

class Controller extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('web::index');
    }

    /**
     * Display a post categories pages.
     */
    public function category($category)
    {
        $category = BlogCategory::findBySlugOrFail($category);

        $posts = $category->posts()->with('author')->orderByDesc('published_at')->simplePaginate(5);

        return view('web::category', compact('category', 'posts'));
    }

    /**
     * Read post categories pages.
     */
    public function read($category, $slug)
    {
        $category = BlogCategory::findBySlugOrFail($category);
        $post = $category->posts()->with('categories', 'tags')->findBySlugOrFail($slug);
        
        $post->incrementViews();

        $related_posts = BlogPost::getRelatedPostsByCategory($post, $category);
        $latest_posts = BlogPost::getLatestPublishedPost();
        $popular_posts = BlogPost::getMostViewedPosts(6);

        return view('web::read', compact('category', 'post', 'related_posts', 'latest_posts', 'popular_posts'));
    }

    /**
     * Display a about page.
     */
    public function about()
    {
        return view('web::about');
    }
}
