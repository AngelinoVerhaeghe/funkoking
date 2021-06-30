<?php

namespace App\Http\Controllers;

use App\FaqCategory;
use App\Http\Requests\FaqCategoriesCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminFaqsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$faqscategories = FaqCategory::withTrashed()->get();*/
        $faqscategories = FaqCategory::paginate(10);
        return view('admin.faqcategories.index', compact('faqscategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.faqcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqCategoriesCreateRequest $request)
    {
        //
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        FaqCategory::create($input);
        Session::flash('created_faqcategory', 'The faq category has been created!');
        return redirect('admin/faqcategories');
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
        $faqcategory = FaqCategory::findOrFail($id);
        return view('admin.faqcategories.edit', compact('faqcategory'));
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
        /*$faqcategory = FaqCategory::findOrFail($id);*/
        //Komt uit hidden part in form de ID
        $faqcategory = FaqCategory::findOrFail($request->faqcategory_id);
        $input = $request->all();
        $input['slug'] = Str::slug($request->name, '-');
        $faqcategory->update($input);
        Session::flash('updated_faqcategory', 'The faq category has been updated!');
        return redirect('admin/faqcategories');
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
        /*$faqscategory = FaqCategory::findOrFail($id);*/
        $faqscategory = FaqCategory::findOrFail($request->faqcategory_id);
        $faqscategory->delete();
        Session::flash('deleted_faqcategory', 'The faq category has been deleted!');
        return redirect('admin/faqcategories');
    }

   /* public function faqcategoryRestore($id){
        FaqCategory::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_faqcategory', 'The faq category has been restored!');
        return redirect('admin/faqcategories');
    }*/
}
