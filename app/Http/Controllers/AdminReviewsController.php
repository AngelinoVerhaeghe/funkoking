<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon;
use function Sodium\compare;

class AdminReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = Review::with(['user', 'product', 'photo'])->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $review = new Review();
        $review->user_id = $request->user_id;
        $review->product_id = $request->product_id;
        $review->email = $request->email;
        $review->rating = $request->rating + 1;
        $review->description = $request->description;
        $review->save();
        Session::flash('created_review', 'The review has been submitted!');
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
    public function edit(Review $review)
    {
        //
        $products = Product::all();
        $users = User::all();
        return view('admin.reviews.edit', compact('review','products', 'users'));
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
        /*$review = Review::findOrFail($id);*/
        $review = Review::findOrFail($request->review_id);
        $input = $request->all();
        $review->update($input);
        Session::flash('updated_review', 'The review has been updated!');
        return redirect('admin/reviews');
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
        $review = Review::findOrFail($request->review_id);
        $review->delete();

        Session::flash('deleted_review', 'The review has been deleted!');
        return redirect()->back();

    }
}
