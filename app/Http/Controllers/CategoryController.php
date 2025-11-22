<?php

namespace Modules\Category\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\App\Http\Requests\CategoryRequest;
use Modules\Category\app\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // Category already exist
        $category = Category::where(['name' => $request->category['name']])->first();
        if ($category) {
            session()->flash('status', 'Category already exists.');

            return redirect(route('categories.index'))->withInput();
        }

        $category = Category::create($request->category);

        session()->flash('status', 'Category created successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Show the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('status', "Category ({$category->name}) deleted successfully.");

        return redirect(route('categories.index'));
    }
}
