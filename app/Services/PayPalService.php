<?php

namespace App\Services;

use App\Order;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use Illuminate\Support\Facades\Auth;

class PayPalService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $clientId;
    protected $clientSecret;

    //Default contructor altijd nodig om connectie te kunnen leggen
    public function __construct()
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    public function handlePayment(Request $request)
    {
        //Hier onze eigen Order ingeven naar de database Order tabel!
        $order = $this->createOrder($request->value, $request->currency);

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $request->value,
            'payment_token' => $request->token,
        ]);

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        session()->put('approvalId', $order->id);

        return redirect($approve->href);
    }

    //Dat zijn tokens dat je terug krijgt als je met de API van Paypal communiceerd
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        //Ben jij wel die client, id en secret onderzoeken
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        return "Basic {$credentials}";
    }

    public function handleApproval()
    {
        if (session()->has('approvalId')) {
            $approvalId = session()->get('approvalId');

            $payment = $this->capturePayment($approvalId);

            $name = $payment->payer->name->given_name;
            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            $amount = $payment->value;
            $currency = $payment->currency_code;

            return redirect()
                ->route('checkout')
                ->withSuccess(['payment' => "Thanks, {$name}. We received your {$amount}{$currency} payment."]);
        }

        return redirect()
            ->route('checkout')
            ->withErrors('We cannot capture the payment. Try again, please');
    }
    public function capturePayment($approvalId)
    {
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    //Functie bepaald kommagetal
    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }
        //2 Decimalen na komma, de japanse Yen is 1
        return 100;
    }

    public function createOrder($value, $currency) //Krijgt hier een value en currency binnen
    {
        return $this->makeRequest(
            'POST', //$method = POST
            '/v2/checkout/orders', //$requestURL in consumesExternalServices
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' =>strtoupper($currency),
                            'value' => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                        ]
                    ]
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('approval'),
                    'cancel_url' => route('cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }



}
