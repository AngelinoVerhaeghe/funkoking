<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminBlogsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$blogcategories = BlogCategory::withTrashed()->paginate(20);*/
        $blogcategories = BlogCategory::paginate(5);
        return view('admin.blogcategories.index', compact('blogcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blogcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        BlogCategory::create($input);
        Session::flash('created_blogcategory', 'The blogcategory has been created!');
        return redirect('admin/blogcategories');
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
        $blogcategory = BlogCategory::findOrFail($id);
        return view('admin.blogcategories.edit', compact('blogcategory'));
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
        //
        /*$category = BlogCategory::findOrFail($id);*/
        //Komt uit hidden part in form de ID
        $category = BlogCategory::findOrFail($request->blogcategory_id);
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        $category->update($input);
        Session::flash('updated_blogcategory', 'The blogcategory has been updated!');
        return redirect('admin/blogcategories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) //$id wordt via knop delete meegegeven klik
    {
        //
       /* $category = BlogCategory::findOrFail($id);*/
        //Vanuit de hidden in field
        $category = BlogCategory::findOrFail($request->blogcategory_id);
        $category->delete();
        Session::flash('deleted_blogcategory', 'The blogcategory has been deleted!');
        return redirect('admin/blogcategories');

    }

   /* public function blogcategoryRestore($id){
        BlogCategory::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_blogcategory', 'The blogcategory has been restored!');
        return redirect('admin/blogcategories');
    }*/
}
