<?php

namespace App\Http\Controllers;

use App\Address;

use App\Cart;
use App\Currency;
use App\Order;
use App\PaymentPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currencies = Currency::all();
        $paymentPlatforms = PaymentPlatform::all();
        $addresses = Address::with(['user'])->get();
        if (!Session::has('cart')) {
            return redirect('index');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            return view('checkout', compact('addresses', 'cart', 'currencies', 'paymentPlatforms', 'user'));
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $products = Session::get('cart')->products;

        /* Dit is de foreach inhoud voor single product info = [
             "quantity" => 1,
             "product_id" => "15",
             "product_name" => "Dr. Raymond Stantz",
             "product_price" => "17.99",
             "product_image" => "de foto file",
             "product_description" => "Description",
         ]*/
        foreach($products as $product){
             $product_info = $product;
             //dd($product_info);
         }

        \Stripe\Stripe::setApiKey('sk_test_51Gv17vGbSxfp9UeI3oNYNC4IE56VbkDD50wz3lafQL8yaOrHG2eUmkBFbgKWoN2gw68HJQiGEfkfyeq9BMv2TJLh00Y0iLdIq6');

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => (Session::get('cart')->totalPrice + 3.95) * 100, //stripe heeft amount standaard x 100
            'currency' => 'eur',
            'receipt_email' => $request->email,
            'description' => 'Betaling vanuit Funko King',
            'source' => $token,
            'metadata' => [
                'Name:' => $user->name,
                'Street:' => $user->address->street,
                'Number:' => $user->address->number,
                'City:' => $user->address->city,
                'Postalcode:' => $user->address->postalcode,
                'Postalbox:' => $user->address->postalbox,
                'Country:' => $user->address->country,
                'Product_id:' => $product_info['product_id'],
                'Product_quantity:' => $product_info['quantity']
            ]


        ]);

        Order::create([
            'user_id' => Auth::user()->id,
            'quantity' => $product_info['quantity'],
            'product_id' => $product_info['product_id'],
            'photo' => $product_info['product_image'],
            'total_price' => Session::get('cart')->totalPrice + 3.95,
            'payment_token' => $token
        ]);

        Session::forget('cart');
        Session::flash('success', 'Bedankt voor uw bestelling, betaling geaccepteerd!');

        return redirect('/paymentCompleted');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}


