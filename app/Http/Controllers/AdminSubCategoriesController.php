<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\SubCategoriesCreateRequest;
use App\Order;
use App\Photo;
use App\Product;
use App\Review;
use App\Stock;
use App\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
     /* $subcategories = SubCategory::withTrashed()->get();*/
        $subcategories = SubCategory::all();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoriesCreateRequest $request)
    {
        //
        $input = $request->all();
        SubCategory::create($input);
        Session::flash('created_subcategory', 'The subcategory has been created!');
        /*return redirect('admin/subcategories');*/
        return redirect()->back();
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
    public function edit(SubCategory $subcategory)
    {
        //
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, SubCategory $subcategory)*/
    public function update(Request $request)
    {
        //
        //Komt uit hidden part in form de ID
        $subcategory = SubCategory::findOrFail($request->subcategory_id);
        $subcategory->update($request->all());
        Session::flash('updated_subcategory', 'The subcategory has been updated!');
        return redirect('admin/subcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function destroy(SubCategory $subcategory)*/
     public function destroy(Request $request)
    {
        //
        $subcategory = SubCategory::findOrFail($request->subcategory_id);
        $subcategory->delete();
        Session::flash('deleted_subcategory', 'The subcategory has been deleted!');
        return redirect()->back();

    }

   /* public function subcategoryRestore($id){
        SubCategory::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_subcategory', 'The subcategory has been restored!');
        return redirect('admin/subcategories');
    }*/

   /* public function subCategory($name){
        //$product = Product::findOrFail($id);
        /* $category = Category::where('subcategory', $name)->first();*/
       /* $subcategory = SubCategory::where('subcategory', $name);
        $products = Product::where('subcategory', '=', $name);
        return view('product', compact('subcategory', 'products'));*/
    //}
}
