<?php

namespace App\Http\Controllers;

use App\Faq;
use App\FaqCategory;
use App\Http\Requests\FaqsCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminFaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$faqs = Faq::withTrashed()->paginate(30);
        $faqcategories = FaqCategory::pluck('name', 'id')->all();
        $faqs = Faq::with(['faqcategory'])->withTrashed()->get();
        return view('admin.faqs.index', compact('faqs', 'faqcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $faqcategories = FaqCategory::pluck('name', 'id')->all();
        return view('admin.faqs.create', compact('faqcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqsCreateRequest $request)
    {
        //
        $input = $request->all();
        Faq::create($input);
        Session::flash('created_faq', 'The faq has been created!');
        return redirect('admin/faqs');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
        $faqcategories = FaqCategory::pluck('name', 'id')->all();
        return view('admin.faqs.edit', compact('faq', 'faqcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       /* $faq = Faq::findOrFail($id);*/
        //Komt uit hidden part in form de ID
        $faq = Faq::findOrFail($request->faq_id);
        $input = $request->all();
        $faq->update($input);
        Session::flash('updated_faq', 'The faq has been updated!');
        return redirect('admin/faqs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $faq = Faq::findOrFail($id);
        $faq->delete();
        Session::flash('deleted_faq', 'The faq has been deleted!');
        return redirect('admin/faqs');
    }

    public function faqRestore($id)
    {
        Faq::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_faq', 'The faq has been restored!');
        return redirect('admin/faqs');
    }

    public function faqPerCategory($id)
    {
        $faqcategories = Faq::with(['faqCategory'])->where('faq_category_id', '=', $id)->get();

        if ($id == 1){
            $faqTitle = Faq::with(['faqCategory'])->where('faq_category_id', '=', '1')->get();
            $subFaqCategory = Faq::with(['faqCategory'])
                ->where('faq_category_id', '=', '1')
                ->get();
            return view('bestellen', compact('faqcategories', 'subFaqCategory'));
        }
        elseif ($id == 2){
            /* $faqTitle = Faq::with(['faqCategory'])->where('id', '=', '2')->get();*/
            $subFaqCategory = Faq::with(['faqCategory'])
                ->where('faq_category_id', '=', '2')
                ->get();
            return view('betalen', compact('faqcategories', 'subFaqCategory'));
        }
        elseif ($id == 3){
            /* $faqTitle = Faq::with(['faqCategory'])->where('id', '=', '3')->get();*/
            $subFaqCategory = Faq::with(['faqCategory'])
                ->where('faq_category_id', '=', '3')
                ->get();
            return view('retourneren', compact('faqcategories', 'subFaqCategory'));
        }
        else{
            /*$faqTitle = Faq::with(['faqCategory'])->where('id', '=', '4')->get();*/
            $subFaqCategory = Faq::with(['faqCategory'])
                ->where('faq_category_id', '=', '4')
                ->get();
            return view('garantie', compact('faqcategories', 'subFaqCategory'));
        }
    }
}
