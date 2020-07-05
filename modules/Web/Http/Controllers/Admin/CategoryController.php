<?php

namespace Modules\Web\Http\Controllers\Admin;

use Str;
use Modules\Web\Models\BlogCategory;
use Modules\Web\Http\Requests\Admin\Category\StoreRequest;
use Modules\Web\Http\Requests\Admin\Category\UpdateRequest;

use Illuminate\Http\Request;
use Modules\Web\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    	$categories = BlogCategory::withCount('posts')->when($request->get('search'), function ($query, $v) {
    		return $query->where('name', 'like', '%'.$v.'%');
    	})->orderByDesc('created_at')->paginate($request->get('limit', 10));

        return view('web::admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
    	$data = $request->validated();
    	$data['slug'] = Str::slug($data['name']);

        auth()->user()->log('Menambah kategori <strong>'.$data['name'.'</strong>']);

        $category = new BlogCategory($data);
        $category->save();

        return redirect($request->get('next', route('web::admin.categories.index')))
                    ->with('success', 'Kategori berhasil dibuat!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $category)
    {
    	return view('web::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, BlogCategory $category)
    {
        $data = $request->validated();
    	$data['slug'] = Str::slug($data['name']);

        auth()->user()->log('Mengubah kategori <strong>'.$category->name.'</strong>');

        $category = $category->fill($data);
        $category->save();

        return redirect($request->get('next', route('web::admin.categories.index')))
                    ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $category)
    {
        auth()->user()->log('Menghapus kategori <strong>'.$category->title.'</strong>');

        $category->delete();

        return redirect(request('next', route('web::admin.categories.index')))
                    ->with('success', 'Kategori berhasil dihapus!');
    }
}
