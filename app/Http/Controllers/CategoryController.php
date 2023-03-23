<?php

namespace Modules\Category\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\app\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
