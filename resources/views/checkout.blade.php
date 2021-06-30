@extends('layouts.frontend')
@section('stripe-extra')
    <script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2 p-0">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="checkout-info" class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="row">
                <div class="col-xl-7 pt-xl-4 pb-5">
                    <div class="col-12 checkout-header d-flex align-items-center justify-content-center pt-3">
                        <div class="mr-3 mb-lg-3"><i class="fas fa-home fa-2x"></i></div>
                        <div><h2 class="m-0 mb-lg-3">BEZORGADRES</h2></div>
                    </div>
                    <div class="card shadow rounded-0 p-3">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center shadow" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{session('success')}}
                            </div>
                        @endif
                        @if(Auth::user()->address_id == '')
                            <div>
                                <p class="lead text-center">Gelieve uw Adresgegevens toe tevoegen op de Account pagina!</p>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('account') }}" class="btn btn-bestellen rounded-0">Account Pagina</a>
                                </div>
                            </div>
                        @else
                            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="name">Naam:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="d-flex">
                                    <div class="form-group w-50 mr-2">
                                        <label for="street">Straat:</label>
                                        <input type="text" class="form-control" name="street" id="street" value="{{ Auth::user()->address->street }}">
                                    </div>
                                    <div class="form-group w-25 mr-2">
                                        <label for="number">Nummer:</label>
                                        <input type="text" class="form-control" name="number" id="number" value="{{ Auth::user()->address->number }}">
                                    </div>
                                    <div class="form-group w-25">
                                        <label for="postalbox">Bus:</label>
                                        <input type="text" class="form-control" name="postalbox" id="postalbox"
                                               value="{{ Auth::user()->address->postalbox }}">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group w-25 mr-2">
                                        <label for="postalcode">Postcode:</label>
                                        <input type="text" class="form-control" name="postalcode" id="postalcode"
                                               value="{{ Auth::user()->address->postalcode }}">
                                    </div>
                                    <div class="form-group w-75">
                                        <label for="city">Plaats:</label>
                                        <input type="text" class="form-control" name="city" id="city" value="{{ Auth::user()->address->city }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country">Land:</label>
                                    <input type="text" class="form-control" name="country" id="country" value="{{ Auth::user()->address->country }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="card mt-5 shadow">
                                    <div class="card-header">
                                        <h2 class="m-0">Betaalgegevens:</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="card-element">
                                                Kredietkaart:
                                            </label>
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-bestellen btn-lg rounded-0 w-100 my-3">
                                    Betalen {{ Session::get('cart')->totalPrice + 3.95 }} €
                                </button>
                            </form>
                        @endif
                    </div>
                    <div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="col-12 checkout-header d-flex align-items-center justify-content-center mt-4">
                        <div class="mr-3 mb-3 mt-lg-2"><i class="fas fa-cash-register fa-2x"></i></div>
                        <div><h2 class="m-0 mb-3 mt-lg-2">UW BESTELLING</h2></div>
                    </div>
                    <div class="card shadow rounded-0 mt-lg-2">
                        @foreach($cart as $item)
                            <div class="cart-item d-lg-flex align-items-center">
                                <div class="col-12 d-flex justify-content-center col-lg-3 item-picture">
                                    <img height="100" width="100"
                                         src="{{ $item['product_image'] ? asset('images/' . $item['product_image']) : 'GEEN FOTOMOMENTEEL' }}"
                                         alt="{{ $item['product_name'] }}">
                                </div>
                                <div class="col-12 d-flex col-lg-5 flex-column justify-content-center align-items-center">
                                    <h4>{{ $item['product_name'] }}</h4>
                                    <p class="text-muted m-0">{{ Str::limit($item['product_description'], 25, ' (...)') }}</p>
                                    <small class="text-muted">Prijs: € {{ $item['product_price'] }}</small>
                                </div>
                                <div class="col-12 d-flex justify-content-center col-lg-4">
                                    <form class="text-xl-center" method="POST" action="{{ action('PagesController@updateQuantity') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="d-flex align-items-center justify-content-center my-3">
                                            <small class="text-muted mr-3">Aantal:</small>
                                            <input class="form-control form-control-sm rounded-0 w-50" type="number" name="quantity"
                                                   value="{{ $item['quantity'] }}" min="1" max="100">
                                        </div>
                                        <input class="form-control form-control-sm" type="hidden" name="id" value="{{ $item['product_id'] }}">
                                        <small class="text-muted">Subtotaal: € {{$item['product_price'] * $item['quantity']}}</small>
                                        <div class="d-flex mb-3 justify-content-center">
                                            <button id="btn-renew" class="btn rounded-0 mr-3" type="submit"><i class="fas fa-sync-alt"></i></button>
                                            <a class="btn btn-success icon-trash rounded-0" href="{{route('removeItem', $item['product_id'])}}"
                                               role="button"><i class="far fa-trash-alt" title="Verwijderen"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card shadow w-100 p-2 p-lg-4 my-4 rounded-0">
                        <div class="d-lg-flex justify-content-lg-between">
                            <p class="text-center text-lg-left">Totaal artikelen
                                @if(Session::get('cart')->totalQuantity > 0)
                                    <span class="badge badge-success badge-pill text-white">{{ Session::get('cart')->totalQuantity }}</span>
                                @endif
                                :</p>
                            <p class="text-center text-lg-left">€ {{ Session::get('cart')->totalPrice }} <small>(Incl. Btw)</small></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Verzendkosten:</p>
                            <p>€ 3.95</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="box-totaal d-flex align-items-center justify-content-between w-100 p-3 border shadow">
                                @if(Session::get('cart')->totalQuantity == 0)
                                    <label for="value">TOTAAL:</label>
                                    <input class="form-control border-0 text-bold" name="value" value="{{ Session::get('cart')->totalPrice }}"
                                           required>€</input>
                                @else
                                <!-- Vaste verzendingskost erbij indien producten in winkelwagen 3.95€ -->
                                    <label for="value"><strong>TOTAAL:</strong></label>
                                    <input class="form-control border-0 w-25 text-bold" name="value"
                                           value="{{ Session::get('cart')->totalPrice + 3.95 }}"
                                           required>€<small>(Incl. Btw)</small></input>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-4">
                <div class="col-6 d-flex justify-content-center">
                    <img class="img-fluid my-4 d-none d-md-none d-lg-none d-xl-block" src="{{ asset('images/checkout-picture.png') }}"
                         alt="checkout-picture">
                </div>
                <div class="col-6 d-none d-md-none d-lg-none d-xl-block">
                    <i class="fas fa-quote-left fa-2x mt-5 my-xl-3"></i>
                    <blockquote class="blockquote">
                        <p>Bedankt voor uw aankopen bij <span>Funko</span> King.</p>
                        <p>Hopelijk zien we u snel terug in onze webshop!</p>
                        <footer class="blockquote-footer"><cite title="Source Title">Mr. MoneyMaker</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js-stripe')
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51Gv17vGbSxfp9UeIiKQIH7hgzxSClATAbcrtfUIwZce5GO3lCvWzmQlZejqVIcHx7K8m1xHSSkl5sT4Cf1tXpFG900i8Qsmjdz');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Montserrat", "Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    /*color: '#aab7c4'*/
                    color: 'black'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            //Info uit de adres form halen en in options steken, dan ook bij de createtoken (in plaatsen) hier onder
            var options = {
                name: document.getElementById('name').value,
                address_street: document.getElementById('street').value,
                address_number: document.getElementById('number').value,
                address_city: document.getElementById('city').value,
                address_zip: document.getElementById('postalcode').value,
            }

            stripe.createToken(card, options).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });


        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            //Hier maakt stripe een hidden token mee aan als er op submit je op drukt
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
