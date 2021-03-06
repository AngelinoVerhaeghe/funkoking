<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoriesCreateRequest;
use App\Order;
use App\Photo;
use App\Product;
use App\Review;
use App\Stock;
use App\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       /* $categories = Category::withTrashed()->get();*/
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesCreateRequest $request)
    {
        //
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        Category::create($input);
        Session::flash('created_category', 'The category has been created!');
        /*return redirect('admin/categories');*/
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Komt uit hidden part in form de ID
        $category = Category::findOrFail($request->category_id);
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        $category->update($input);
        Session::flash('updated_category', 'The category has been updated!');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $category = Category::findOrFail($request->category_id);
        //$category = Category::findOrFail($id);
        $category->delete();
        Session::flash('deleted_category', 'The category has been deleted!');
        return redirect()->back();
    }

   /* public function categoryRestore($id){
        Category::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_category', 'The category has been restored!');
        return redirect('admin/categories');
    }*/



}
