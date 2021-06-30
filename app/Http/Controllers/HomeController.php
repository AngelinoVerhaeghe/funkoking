<?php

namespace App\Http\Controllers;


use App\Order;
use App\Photo;
use App\Product;
use App\Review;
use App\Role;
use App\Stock;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['photo', 'category', 'subcategory'])->take(4)->latest('created_at')->get();
        $users = User::with(['photo'])->take(4)->latest('created_at')->get();//Volgens created_at sorteren 4 weergeven
        return view('admin.index', compact('users', 'products'));
    }

}
