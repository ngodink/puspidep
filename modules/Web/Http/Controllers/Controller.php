<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Web\Models\BlogCategory;
use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogPostComment;
use App\Http\Controllers\Controller as AppController;

class Controller extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = BlogCategory::get();

        $latest_posts = BlogPost::getLatestPublishedPost();
        $popular_posts = BlogPost::getMostViewedPosts(6);

        return view('web::index', compact('categories', 'latest_posts', 'popular_posts'));
    }

    /**
     * Display a post categories pages.
     */
    public function category($category)
    {
        $category = BlogCategory::findBySlugOrFail($category);

        $posts = $category->posts()->with('author')->orderByDesc('published_at')->simplePaginate(5);
        $latest_posts = BlogPost::getLatestPublishedPost();
        $popular_posts = BlogPost::getMostViewedPosts(6);

        return view('web::category', compact('category', 'posts', 'latest_posts', 'popular_posts'));
    }

    /**
     * Read post categories pages.
     */
    public function read($category, $slug)
    {
        $category = BlogCategory::findBySlugOrFail($category);
        $post = $category->posts()->with(['categories', 'tags', 'comments' => function($comment) {
                    return $comment->with('commentator')->whereNotNull('published_at')->orderByDesc('published_at');
                }])->findBySlugOrFail($slug);
        
        $post->incrementViews();

        $related_posts = BlogPost::getRelatedPostsByCategory($post, $category);
        $latest_posts = BlogPost::getLatestPublishedPost();
        $popular_posts = BlogPost::getMostViewedPosts(6);

        return view('web::read', compact('category', 'post', 'related_posts', 'latest_posts', 'popular_posts'));
    }

    /**
     * Comment the post.
     */
    public function comment(Request $request, BlogPost $post)
    {
        $this->validate($request, [
            'content' => 'required|string|max:191'
        ]);

        $comment = new BlogPostComment([
            'content' => $request->input('content'),
            'commentator_id' => auth()->id()
        ]);

        $post->comments()->save($comment);

        return redirect()->back();
    }

    /**
     * Display a about page.
     */
    public function about()
    {
        return view('web::about');
    }
}
