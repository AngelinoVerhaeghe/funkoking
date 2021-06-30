<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');
        //Als er op de knop payknop wordt gedrukt zal er hier iets gevuld worden
        $this->paymentPlatformResolver = $paymentPlatformResolver;

    }

    /**
     * Obtain a payment details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
        $rules = [
            'value' => ['required', 'numeric', 'min:5'],
            'currency' => ['required', 'exists:currencies,iso'],
            'payment_platform' => ['required', 'exists:payment_platforms,id'],
        ];

        $request->validate($rules);

        $request->value = Session::get('cart')->totalPrice + 3.95;
        $request->currency = "eur";
        $request->payment_platform = "1";

       /* dd($request);*/

        //Functie om te weten welke pay systeem er binnen komt, paypal of stripe.....
        //Paypal
        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);


        return $paymentPlatform->handlePayment($request);
    }

    public function approval()
    {
        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }

        return redirect()
            ->route('checkout')
            ->withErrors('We cannot retrieve your payment platform. Try again, please.');
    }

    public function cancelled()
    {
        return redirect()
            ->route('checkout')
            ->withErrors('You cancelled the payment.');
    }
}
