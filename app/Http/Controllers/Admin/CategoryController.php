<?php

namespace Modules\Category\app\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\app\Http\Requests\StoreCategoryRequest;
use Modules\Category\app\Models\Category;
use Plank\Mediable\Facades\MediaUploader;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('category::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::where(['name' => $request->category['name']])->first();
        if ($category) {
            session()->flash('status', 'Category already exists.');
            return redirect(route('admin.category.index'))->withInput();
        }

        $category = Category::create($request->category);

        // Media
        if ($request->filled('image')) {
            $media = MediaUploader::fromSource($request->file('images'))
                ->useHashForFilename()
                ->onDuplicateUpdate()
                ->upload();

            $category->syncMedia($media, 'image');
        }

        session()->flash('status', "Category ({$category->name}) created successfully.");
        return redirect(route('admin.category.index'));
    }

    /**
     * Show the specified resource.
     * @param int Category $category
     * @return Renderable
     */
    public function show(Category $category)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int Category $category
     * @return Renderable
     */
    public function edit(Category $category)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int Category $category
     * @return Renderable
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int Category $category
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('status', "Category ({$category->name}) deleted successfully.");
        return redirect(route('admin.category.index'));
    }
}
