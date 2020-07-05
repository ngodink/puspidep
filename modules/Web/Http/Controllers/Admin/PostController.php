<?php

namespace Modules\Web\Http\Controllers\Admin;

use Str;
use Storage;
use Modules\Account\Models\User;
use Modules\Web\Models\BlogCategory;
use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogPostComment;
use Modules\Web\Http\Requests\Admin\Post\StoreRequest;
use Modules\Web\Http\Requests\Admin\Post\UpdateRequest;

use Illuminate\Http\Request;
use Modules\Web\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    	$posts = BlogPost::withCount('unpublishedComments')->with('categories')->when($request->get('search'), function ($query, $v) {
    		return $query->where('title', 'like', '%'.$v.'%');
    	})->when($request->get('category'), function ($query, $v) {
    		return $query->whereHas('categories', function ($category) use ($v) {
                return $category->where('id', $v);
            });
    	})->when($request->get('trashed'), function ($query, $v) {
    		return $query->onlyTrashed();
    	})->orderByDesc('created_at')->paginate($request->get('limit', 10));

    	$categories = BlogCategory::all();

        $latest_comments = BlogPostComment::orderByDesc('created_at')->limit(5)->get();

        return view('web::admin.posts.index', compact('posts', 'categories', 'latest_comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    	$categories = BlogCategory::all();
        $authors = User::whereAdmin()->get();

    	return view('web::admin.posts.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $content = BlogPost::makeContent($request->input('content'));

        $cover = $request->has('file')
                    ? $request->file('file')->store('blogs/'.date('Ymd'))
                    : null;

        $post = new BlogPost([
            'title'             => $request->input('title'),
            'img'               => $cover,
            'content'           => $content,
            'author_id'         => $request->input('author_id'),
            'commentable'       => $request->input('commentable', 0),
            'visibled'          => 1,
            'published_at'      => $request->input('published_at'),
        ]);

        $post->save();
        $post->categories()->sync($request->input('categories'));

        auth()->user()->log('Membuat postingan <strong>'.$post->title.'</strong>');

        return redirect($request->get('next', route('web::admin.posts.index')))
                    ->with('success', 'Postingan berhasil dibuat!');

    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, BlogPost $post)
    {
        $post->load('comments');

        return view('web::admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $post)
    {
    	$categories = BlogCategory::all();
        $authors = User::whereAdmin()->get();

    	return view('web::admin.posts.edit', compact('post', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, BlogPost $post)
    {
        $content = BlogPost::makeContent($request->input('content'));
        $cover = $request->has('file')
                    ? Storage::putFile('blogs/'.date('Ymd'), $request->file('file'))
                    : null;

        $post = $post->fill([
            'title'             => $request->input('title'),
            'img'               => $cover ?? $post->img,
            'content'           => $content,
            'author_id'         => $request->post('author_id'),
            'commentable'       => $request->input('commentable', 0),
            'visibled'          => 1,
            'published_at'      => $request->input('published_at'),
        ]);

        $post->save();
        $post->categories()->sync($request->input('categories'));

        auth()->user()->log('Mengubah postingan <strong>'.$post->title.'</strong>');

        return redirect($request->get('next', route('web::admin.posts.index')))
                    ->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $post)
    {
        $post->delete();

        auth()->user()->log('Membuang postingan <strong>'.$post->title.'</strong>');

        return redirect(request('next', route('web::admin.posts.index')))
                    ->with('success', 'Postingan berhasil dibuang!');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(BlogPost $post)
    {
        $post->restore();

        auth()->user()->log('Memulihkan postingan <strong>'.$post->title.'</strong>');

        return redirect(request('next', route('web::admin.posts.index')))
                    ->with('success', 'Postingan berhasil dipulihkan!');
    }

    /**
     * Kill the specified resource from storage.
     */
    public function kill(BlogPost $post)
    {
        auth()->user()->log('Menghapus postingan <strong>'.$post->title.'</strong>');

        $post->forceDelete();

        return redirect(request('next', route('web::admin.posts.index')))
                    ->with('success', 'Postingan berhasil dihapus secara permanen!');
    }
}
