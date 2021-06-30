@extends('layouts.frontend')
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop!</a></li>
                <li class="breadcrumb-item active" aria-current="page">Winkelwagen</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="cart-products" class="row pb-5">
        <div class="col-lg-8 offset-lg-2">
            <header>
                <h2 class="pl-3 pl-lg-0 mt-3 pb-3">Winkelwagen</h2>
            </header>
        </div>
        <div class="col-lg-8 offset-lg-2 d-lg-flex">
            <div class="col-lg-7">
                @if(Session::has('success_message'))
                    <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{session('success_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(Session::has('remove_message'))
                    <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{session('remove_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card shadow">
                    @if(Session::get('cart')->totalQuantity > 0)
                    @foreach($cart as $item)
                        <div class="cart-item d-lg-flex align-items-center">
                            <div class="col-12 d-flex justify-content-center col-lg-3 item-picture">
                               <img height="150"
                                     src="{{ $item['product_image'] ? asset('images/' . $item['product_image']) : 'GEEN FOTOMOMENTEEL' }}"
                                     alt="{{ $item['product_name'] }}">
                            </div>
                            <div class="col-12 d-flex col-lg-5 flex-column justify-content-center align-items-center">
                                <h3>{{ $item['product_name'] }}</h3>
                                <p class="text-muted m-0">{{ Str::limit($item['product_description'], 25, ' (...)') }}</p>
                                <small class="text-muted">Prijs: € {{ $item['product_price'] }}</small>
                            </div>
                            <div class="col-12 d-flex justify-content-center col-lg-4">
                            <form class="text-xl-center" method="POST" action="{{ action('PagesController@updateQuantity') }}" enctype="multipart/form-data">
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
                    @else
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <p class="lead m-0">Uw winkelwagen is leeg.</p>
                        </div>
                    @endif
                </div>
                    <div class="d-flex justify-content-center justify-content-lg-start mb-3">
                        <a id="btn-continue" href="{{route('shop')}}" class="btn btn-secondary shadow rounded-0 mt-4">Verder Winkelen</a>
                    </div>
            </div>
            <div class="col-lg-5">
                <div class="card text-center w-100 shadow p-4">
                    <p><i class="fas fa-check mr-3"></i><span>Gratis </span>verzending vanaf 50,-</p>
                    <p><i class="fas fa-check mr-3"></i> 30 dagen bedenktijd en gratis retourneren</p>
                    <p><i class="fas fa-check mr-3"></i> Veilig & Vertrouwd</p>
                </div>
                <div class="card shadow w-100 p-2 p-lg-4 mt-4">
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
                        <div class="box-totaal d-flex justify-content-between w-100 p-3">
                            <p class="font-weight-bold m-0">TOTAAL:</p>
                            @if(Session::get('cart')->totalQuantity == 0)
                                <p class="font-weight-bold m-0">€ {{ Session::get('cart')->totalPrice }}</p>
                            @else
                                <!-- Vaste verzendingskost erbij indien producten in winkelwagen 3.95€ -->
                                <p class="font-weight-bold m-0">€ {{ Session::get('cart')->totalPrice + 3.95 }} <small>(Incl. Btw)</small></p>
                                @endif
                        </div>
                    </div>
                    <a id="btn-renew" href="{{ route('checkout') }}" class="btn rounded-0 shadow mr-md-3 mt-4">Checkout</a>
                </div>
            </div>
        </div>
    </section>
   {{-- <section id="gifts" class="row">
        <div class="col-lg-8 offset-lg-2 offset-sm-1 offset-md-2 d-lg-flex justify-content-sm-center py-3 py-lg-5">
            <div class="col-12 col-sm-10 col-lg-6 p-0">
                <form>
                    <div class="form-group text-center text-md-left">
                        <label for="formGroupExampleInput">Heb je een kortingscode?</label>
                        <div class="korting-box d-flex">
                            <input type="text" class="form-control tbox rounded-0 p-lg-0" id="formGroupExampleInput"
                                   placeholder="Vul de kortingscode in">
                            <button type="button" class="btn rounded-0">Inwisselen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-10 col-lg-6 p-0">
                <form>
                    <div class="form-group text-center text-md-left ml-lg-5">
                        <label for="formGroupExampleInput1">Heb je een geschenkbon?</label>
                        <div class="korting-box d-flex">
                            <input type="text" class="form-control tbox rounded-0 p-lg-0" id="formGroupExampleInput1"
                                   placeholder="Vul je geschenkbon code in">
                            <button type="button" class="btn rounded-0">Inwisselen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>--}}
    {{-- <section id="totaal" class="row">
         <div class="col-lg-8 offset-lg-2 my-4">
             <div class="d-lg-flex">
                 <div class="col-12 col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center">
                     <img class="img-fluid" src="images/side-picture4.png" alt="image">
                 </div>
                 <div class="flex-md-column d-md-flex justify-items-md-center col-lg-6">
                     <div class="row d-flex justify-content-center">
                         <div class="col-11 col-sm-10 col-md-8 col-lg-12 p-0">
                             <div class="card text-center w-100 shadow p-4 mt-4">
                                 <p><i class="fas fa-check mr-3"></i><span>Gratis </span>verzending vanaf 50,-</p>
                                 <p><i class="fas fa-check mr-3"></i> 30 dagen bedenktijd en gratis retourneren</p>
                                 <p><i class="fas fa-check mr-3"></i> Veilig & Vertrouwd</p>
                             </div>
                         </div>
                     </div>
                     <div class="row d-flex justify-content-center">
                         <div class="col-11 col-sm-10 col-md-8 col-lg-12 p-0">
                             <div class="card shadow w-100 p-4 mt-4">
                                 <div class="d-flex justify-content-between">
                                     <p>Totaal artikelen (3):</p>
                                     <p>€ 44,97</p>
                                 </div>
                                 <div class="d-flex justify-content-between">
                                     <p>Verzendkosten:</p>
                                     <p>€ 3,95</p>
                                 </div>
                                 <div class="d-flex justify-content-between">
                                     <div class="box-totaal d-flex justify-content-between w-100 p-3">
                                         <p class="font-weight-bold m-0">TOTAAL:</p>
                                         <p class="font-weight-bold m-0">€ 48,92</p>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
         <div class="col-lg-8 offset-lg-2 d-flex justify-content-center mt-4 mb-5">
             <a id="btn-checkout" href="#" class="btn rounded-0 shadow p-4">Checkout</a>
         </div>
     </section>--}}
@endsection
