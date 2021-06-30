@extends('layouts.frontend')
@section('title')
    Funko King | Home
@endsection
@section('content')
    <div id="app">
        <section id="header" class="row">
            <div class="col-lg-12 p-0 p-lg-0  m-0">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('images/Slider1small.jpg')}}" class="img-fluid d-block w-100" alt="HeaderImage">
                        <div id="header-content" class="carousel-caption d-md-block text-left pb-0">
                            <header>
                                <h5>THE BEST</h5>
                                <div class="text">
                                    <h1 id="brand-name">FUNKO KING</h1>
                                </div>
                            </header>
                            <p class="mb-0">Where <span>Pops!</span> are King</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="best-sellers" class="row">
            <div class="col-lg-12 text-center">
                <h2 class="pt-5">TOPPERS</h2>
                <p><i>De beste producten van bij ons.</i></p>
                <p>Bij Funko King vind je diverse Funko Pop Vinyl figuren.</p>
                <p>Deze Funko poppen zijn grappige sculpturen van allerlei bekende personages uit de film- en
                    cartoonwereld.</p>
                <p>Er zijn bijvoorbeeld Funko Pop Vinyl - Actie figuren en Sleutelhangers verkrijgbaar van bekende tv- en
                    filmseries.</p>
                <p>Funko poppen van Disney en natuurlijk Funko poppen van Star Wars.</p>
                <h2 class="pt-5">NIEUWE PRODUCTEN</h2>
            </div>
            <div class="col-xl-10 offset-xl-1">
                <div id="carousel-slide" class="row d-flex justify-content-center mb-5">
                    @if($products)
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-2">
                                <article>
                                    <div class="card rounded-0 mt-3">
                                        <img class="img-fluid image card-img-top p-2"
                                             src="{{$product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/250x400?text=No Image'}}"
                                             alt="Product Image">
                                        <div class="card-body p-0">
                                            <h5 class="card-title text-center">{{$product->name}}</h5>
                                            <p class="card-text text-center">€ {{$product->price}}</p>
                                            <div class="d-flex">
                                                <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                    <a href="{{route('addToCart', $product->id)}}" class="btn btn-primary rounded-0 w-100">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </div>
                                                <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                    <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary rounded-0 w-100">
                                                        <p class="m-0">Meer info</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <section id="service" class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 text-center py-3 py-xl-4">
                <div class="pb-3"><i class="far fa-gem fa-2x"></i></div>
                <h5>SPECIALE ACTIES</h5>
                <p class="m-0">Op onze Producten</p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center py-3 py-xl-4">
                <div class="pb-3"><i class="fas fa-paper-plane fa-2x"></i></div>
                <h5>GRATIS VERZENDING</h5>
                <p class="m-0">Vanaf € 50</p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center py-3 py-xl-4">
                <div class="pb-3"><i class="fas fa-retweet fa-2x"></i></div>
                <h5>GRATIS RETOURNEREN</h5>
                <p class="m-0">Onze kwaliteit</p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center py-3 py-xl-4">
                <div class="pb-3"><i class="fas fa-rocket fa-2x"></i></div>
                <h5>VERZENDING</h5>
                <p class="m-0">Voor 20u besteld</p>
                <p class="m-0">morgen in huis</p>
            </div>
        </section>
        <section id="sales" class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-lg-flex p-0">
                <img class="img-fluid " src="{{ asset('images/sa1.jpg') }}" alt="images">
                <div class="card col-8 col-sm-8 col-md-7 col-lg-8 text-center px-3 py-4">
                    <h2>SLEUTELHANGERS</h2>
                    <p class="m-0">30% KORTING</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-lg-flex p-0">
                <img class="img-fluid" src="{{ asset('images/sa2.jpg') }}" alt="images">
                <div class="card card2 col-8 col-sm-8 col-md-7 col-lg-8 text-center px-3 py-4">
                    <h2>FUNKO POP</h2>
                    <p class="m-0">KOOPJES</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-lg-flex p-0">
                <img class="img-fluid" src="{{ asset('images/sa3.png') }}" alt="images">
                <div class="card card3 col-8 col-sm-8 col-md-7 col-lg-8 text-center px-3 py-4">
                    <h2>ACTIE FIGUREN</h2>
                    <p class="m-0">PROMOTIE</p>
                </div>
            </div>
        </section>
        <section id="aanbevolen" class="row">
            <div class="col-lg-12 text-center p-0">
                <h2 class="pt-5">AANBEVOLEN</h2>
                <p class="pb-4 pb-lg-2"><i>Nieuwe Pop's! uit onze stock</i></p>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <div id="carousel-slide" class="row d-flex justify-content-center mb-4 mb-lg-5">
                    @foreach($aanbevolenProducts as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <article>
                                <div class="card rounded-0 mt-3">
                                    <img class="img-fluid image card-img-top p-2"
                                         src="{{$product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/250x400?text=No Image'}}"
                                         alt="Product Image">
                                    <div class="card-body p-0">
                                        <h5 class="card-title text-center">{{$product->name}}</h5>
                                        <p class="card-text text-center">€ {{$product->price}}</p>
                                        <div class="d-flex">
                                            <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                <a href="{{route('addToCart', $product->id)}}" class="btn btn-primary rounded-0 w-100">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary rounded-0 w-100">
                                                    <p class="m-0">Meer info</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="bg-newsletter" class="row d-block d-sm-block d-md-block d-lg-block d-xl-none">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid" src="{{asset('images/newsletter-background.jpg')}}" alt="image">
                    <div class="carousel-caption">
                        <div class="card">
                            <h3>SCHRIJF JE IN OP ONZE NIEUWSBRIEF</h3>
                            <p>Nieuws en Speciale actie's</p>
                            <form action="email">
                                <div><input class="rounded-0" type="email" placeholder="E-mail" size="25" required></div>
                                <div class="py-3">
                                    <button type="submit" class="btn">Verzenden</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="nieuwsbrief" class="row d-none d-sm-none d-md-none d-lg-none d-xl-block parallax">
            <div id="bgnewsletter" class="col-lg-8 offset-lg-2 d-flex justify-content-center py-5">
                <div class="col-lg-9 p-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>SCHRIJF JE IN OP ONZE NIEUWSBRIEF</h3>
                            <p>Nieuws en Speciale actie's</p>
                            <form action="email">
                                <div><input type="email" placeholder="E-mail" size="25" required></div>
                                <div class="py-3">
                                    <button type="submit" class="btn">Verzenden</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
