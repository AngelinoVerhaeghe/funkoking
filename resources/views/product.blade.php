@extends('layouts.frontend')
@section('title')
    Funko King | Product
@endsection
@section('scripts')
    <!-- jQuery 1.8 or later, 33 KB -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Fotorama from CDNJS, 19 KB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@endsection
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2 p-0">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="detail-product" class="row">
        @if(Session::has('created_review'))
            <div class="col-12 col-lg-8 offset-lg-2 alert alert-success alert-dismissible fade show text-center" role="alert">
                {{session('created_review')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-lg-8 offset-lg-2 d-md-flex">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-center">
                <div class="fotorama mb-xl-5" data-nav="thumbs">
                    <a href="{{ asset('images/' . $product->photo->file) }}"><img class="img-fluid"
                                                                                src="{{ asset('images/' . $product->photo->file) }}"
                                                                                alt="image"></a>
                    <a href="{{ asset('images/' . $product->photo->file) }}"><img class="img-fluid"
                                                                                src="{{ asset('images/' . $product->photo->file) }}"
                                                                                alt="image"></a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h2 class="text-center text-sm-center text-md-left mt-5 mt-sm-5 mt-md-5 mt-lg-5 mt-xl-5">{{ $product->title }}</h2>
                <p class="prijs text-center text-sm-center text-md-left mt-4"><i class="fas fa-tags fa-rotate-90 mr-3"></i>€ {{ $product->price }}</p>
                {{-- <p class="d-flex align-items-center m-0 ml-auto score">Score: {{$product->review->rating}}</p>--}}
                {{-- <div class="stars d-flex justify-content-center justify-content-sm-center justify-content-md-start"
                      data-rating="3">
                     <span class="star">&nbsp;</span>
                     <span class="star">&nbsp;</span>
                     <span class="star">&nbsp;</span>
                     <span class="star">&nbsp;</span>
                     <span class="star">&nbsp;</span>
                 </div>--}}
                <p class="text-center text-sm-center text-md-left mt-4">Categorie: {{ $product->subcategory->name }}</p>
                <p class="text-center text-sm-center text-md-left mt-3">
                    Beschikbaarheid:
                   {{-- @if( $stocks )
                        @foreach( $stocks as $stock )
                            @if( $stock->quantity >= 1 )--}}
                                <span class="text-success">In Stock</span>
                           {{-- @elseif( $stock->quantity < 1 )
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        @endforeach
                    @endif--}}
                </p>
                <p class="text-center text-sm-center text-md-left mt-3 w-75">{{ $product->subtitle }}</p>

                <hr>
                {{--  <div class="d-flex mt-xl-5">
                      <div
                          class="col-4 col-sm-4 offset-sm-1 offset-md-0 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center justify-content-sm-end justify-content-md-center justify-content-xl-start align-items-center">
                          <p class="m-0">Aantal:</p>
                      </div>
                      <div
                          class="input-group number-spinner col-8 col-sm-4 col-md-6 col-lg-8 col-xl-5 d-flex justify-content-center align-items-center">
                    <span class="input-group-btn">
                        <button class="btn btn-default knop rounded-0" data-dir="dwn"><span><i class="fas fa-minus icon"></i></span></button>
                    </span>
                          <input type="text" class="form-control text-center" name="quantity" value="1">
                          <span class="input-group-btn">
                        <button class="btn btn-default knop rounded-0" data-dir="up"><span><i class="fas fa-plus icon"></i></span></button>
                    </span>
                      </div>
                  </div>--}}
                {{--  <div class="d-flex align-items-center my-3">
                      <p class="mr-3 m-0">Aantal:</p>
                      <input class="form-control form-control-sm rounded-0 w-25" type="number" name="quantity" value="1">
                  </div>--}}
                <div class="d-flex justify-content-center justify-content-lg-start my-4">
                    <a href="{{ route('addToCart', $product->id) }}" id="knop-cart" class="btn btn-outline-dark rounded-0 shadow"><i
                            class="cart fas fa-shopping-cart mr-3"></i>Winkelwagen
                    </a>
                    {{-- <button id="knop-wish" class="btn btn-outline-dark rounded-0 shadow"><i class="cart far fa-heart"
                                                                                             title="Verlanglijst"></i>
                     </button>--}}
                </div>
                <p class="d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-xl-start mt-4">
                    <i class="fas fa-shipping-fast mr-3"></i>Vandaag voor 20u besteld, morgen in huis.</p>
                <hr>
            </div>
        </div>
    </section>
    <section id="product-mid" class="row">
        <div class="col-lg-8 offset-lg-2 py-5">
            <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mr-3 active" id="beschrijving-tab" data-toggle="tab" href="#beschrijving"
                       role="tab" aria-controls="beschrijving" aria-selected="true">Beschrijving</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                       aria-controls="reviews" aria-selected="false">Reviews</a>
                </li>
                <li class="nav-item mt-3 mt-sm-0 mb-4">
                    <a class="nav-link" id="beoordelingen-tab" data-toggle="tab" href="#beoordelingen" role="tab"
                       aria-controls="beoordelingen" aria-selected="false">Beoordeling</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="col-12 tab-pane fade show active" id="beschrijving" role="tabpanel"
                     aria-labelledby="beschrijving-tab">
                    <p class="mt-4">{!! $product->description !!}</p>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane fade mt-4" id="beoordelingen" role="tabpanel"
                     aria-labelledby="beoordelingen-tab">
                    @if( Auth::check() )
                        <div class="d-xl-flex">
                            <div class="col-xl-6">
                                {{-- <form>--}}
                                <h2 class="text-center text-md-left mb-4 mt-xl-5">Plaats een beoordeling:</h2>
                                {!! Form::open(['method' => 'POST', 'action' => 'AdminReviewsController@store']) !!}
                                <div class="form-row flex-lg-column">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        {!! Form::label('name', 'Naam:') !!} {{ Auth::User()->name }}
                                        <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 mb-4">
                                        {!! Form::label('email', 'E-mail:') !!} {{ Auth::User()->email }}
                                        <input type="hidden" name="email" value="{{ Auth::User()->email }}">
                                    </div>
                                </div>
                                <div
                                    class="d-sm-flex justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-start">
                                    <h2 class="text-center text-md-left d-sm-flex align-items-center m-0 mr-xl-5">Beschrijving:</h2>
                                    <div class="d-sm-flex align-items-center">
                                        <h2 class="text-center m-0 mr-3 mt-3 mt-sm-0">Score:</h2>
                                        {!! Form::select('rating', ['' => 'Kies', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], null, ['class' => 'form-control']) !!}
                                        {{--<div class="text-center stars" data-rating="3">
                                            <span class="star">&nbsp;</span>
                                            <span class="star">&nbsp;</span>
                                            <span class="star">&nbsp;</span>
                                            <span class="star">&nbsp;</span>
                                            <span class="star">&nbsp;</span>
                                        </div>--}}
                                    </div>
                                </div>
                                {!! Form::textarea('description', null, ['class' => 'col-12 col-sm-12 col-md-12 col-lg-12 mt-3 form-control', 'rows' => 7, 'required']) !!}
                                {{-- <textarea class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 form-control" id="exampleFormControlTextarea1"
                                           rows="7"></textarea>--}}
                                <div class="text-center text-md-left mt-4">
                                    {!! Form::button('Verzenden', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                </div>
                                {!! Form::close() !!}
                                {{--</form>--}}
                            </div>
                            <div class="col-xl-6">
                                <div class="col-12 d-flex justify-content-center mt-5 mt-xl-5">
                                    <img class="img-fluid" src="{{ asset('images/harry-comment.png') }}" alt="image">
                                </div>
                                <div class="col-12 mt-xl-4">
                                    <i class="fas fa-quote-left fa-2x mt-5 mt-xl-3"></i>
                                    <blockquote class="blockquote">
                                        <p>Happiness can be found even in the darkest of times,
                                            If one only remembers to turn on the light.</p>
                                        <footer class="blockquote-footer"><cite title="Source Title">Harry Potter</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    @else
                        <div>
                            <p>Je moet ingelogd zijn om een beoordeling te plaatsen!</p>
                        </div>
                    @endif
                </div>
                <div class="col-12 tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    @if( count($reviews) > 0 )
                        @foreach( $reviews as $review )
                           @if( $review->product->id == $product->id )
                                <div class="col-12 p-0">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 offset-xl-1 card p-0 mt-4 shadow">
                                        <div class="d-flex align-items-center card-header">
                                            <div class="d-flex">
                                                @if( Auth::User()->photo == '' )
                                                    <img class="mr-3" height="40" width="40"
                                                         src="http://place-hold.it/30x30?text=."
                                                         alt="icon">
                                                @else
                                                    <img class="mr-3" height="40" width="40"
                                                         src="{{ asset('images/' . Auth::User()->photo->file) }}"
                                                         alt="icon">
                                                @endif
                                                <h3 class="d-flex m-0 mr-sm-3 mr-xl-4 align-items-center">{{ $review->user->name }}</h3>
                                            </div>
                                            {{-- <div class="flex-column">--}}
                                            {{--<div class="stars" data-rating="{{$review->rating}}">
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                                  <span class="star"></span>
                                              </div>--}}
                                            <p class="d-flex align-items-center m-0 ml-auto score">Score: {{ $review->rating }}</p>
                                            {{-- </div>--}}
                                        </div>
                                        <div class="card-body">
                                            <p class="text-center text-sm-left mt-4 mx-3">{{ $review->description }}</p>
                                            <footer class="blockquote-footer d-flex justify-content-end m-0"><cite
                                                    title="Source Title"> {{ $review->created_at->diffForHumans() }}</cite></footer>
                                        </div>
                                    </div>
                                </div>
                           @endif
                        @endforeach
                    @else
                        <div>
                            <p>Nog geen beoordelingen. Voeg als eerste een beoordeling toe!</p>
                        </div>
                    @endif
                    {{-- <div class="col-12 p-0">
                         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 offset-xl-1 p-0">
                             <div class="d-flex align-items-center ml-xl-4 mt-5">
                                 <img class="img-fluid mr-3" src="images/icon-review-2.png" alt="icon">
                                 <div class="flex-column">
                                     <h3 class="m-0 mr-sm-3 mr-xl-4">Susan Walker</h3>
                                     <div class="text-center stars" data-rating="3">
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                     </div>
                                 </div>
                             </div>
                             <p class="text-center text-sm-left mt-4 ml-xl-4">Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het
                                 merendeel
                                 heeft te lijden gehad van wijzigingen in een of andere vorm, door ingevoegde humor
                                 of willekeurig gekozen woorden die nog niet half geloofwaardig ogen.</p>
                         </div>
                     </div>
                     <div class="col-12 p-0">
                         <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 offset-xl-1 p-0">
                             <div class="d-flex align-items-center mt-5">
                                 <img class="img-fluid mr-3" src="images/icon-review-3.png" alt="icon">
                                 <div class="flex-column">
                                     <h3 class="m-0 mr-sm-3 mr-xl-4">Eric Pride</h3>
                                     <div class="text-center stars" data-rating="3">
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                         <span class="star">&nbsp;</span>
                                     </div>
                                 </div>
                             </div>
                             <p class="text-center text-sm-left mt-4">Er zijn vele variaties van passages van Lorem Ipsum beschikbaar maar het
                                 merendeel
                                 heeft te lijden gehad van wijzigingen in een of andere vorm, door ingevoegde humor
                                 of willekeurig gekozen woorden die nog niet half geloofwaardig ogen.</p>
                         </div>
                     </div>--}}
                </div>
            </div>
        </div>
    </section>
    <section id="carousel-slide" class="row">
        <!--        Mobile Carousel-->
        <div class="col-12 col-sm-10 offset-sm-1 d-block d-sm-block d-md-none d-lg-none d-xl-none my-5">
            <h2 class="text-center text-sm-center mb-4">Toppers</h2>
            <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                <span aria-hidden="true"><i class="fas fa-chevron-right fa-2x"></i></span>
                <span class="sr-only">Next</span>
            </a>
            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    {{--  @foreach($perFour as $product)--}}
                    <div class="carousel-item{{-- {{ $loop->first ? 'active' : ''}}--}}">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-sm-10">
                                <div class="card rounded-0 mt-3">
                                    <img class="img-fluid image card-img-top"
                                         src="{{ $product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/250x400?text=No Image' }}"
                                         alt="Product Image">
                                    <div class="card-body p-0">
                                        <h5 class="card-title text-center">{{$product->name}}</h5>
                                        <p class="card-text text-center">€ {{$product->price}}</p>
                                        <div class="d-flex">
                                            <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary rounded-0 w-100">
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
                            </div>
                        </div>
                    </div>
                    {{--@endforeach--}}
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                <span aria-hidden="true"><i class="fas fa-chevron-left fa-2x"></i></span>
                <span class="sr-only">Previous</span>
            </a>
        </div>
        <!--        Mobile Carousel ends-->
        <div class="col-lg-8 offset-lg-2 d-none d-sm-none d-md-block d-lg-block d-xl-block my-5">
            <h2 class="text-md-center text-lg-left text-xl-left mb-4">Toppers</h2>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span aria-hidden="true"><i class="fas fa-chevron-right fa-2x"></i></span>
                <span class="sr-only">Next</span>
            </a>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach( $photosSlider->chunk(4) as $four )
                        <div class="carousel-item @if( $loop->first ) active @endif">
                            <div class="row">
                                @foreach( $four as $product )
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <div class="card rounded-0 mt-3">
                                            <img class="img-fluid image card-img-top"
                                                 src="{{ $product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/250x400?text=No Image' }}"
                                                 alt="Product Image">
                                            <div class="card-body p-0">
                                                <h5 class="card-title text-center">{{ $product->name }}</h5>
                                                <p class="card-text text-center">€ {{ $product->price }}</p>
                                                <div class="d-flex">
                                                    <div class="col-xl-6 d-md-flex justify-content-center p-0">
                                                        <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary rounded-0 w-100">
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span aria-hidden="true"><i class="fas fa-chevron-left fa-2x"></i></span>
                <span class="sr-only">Previous</span>
            </a>
        </div>
    </section>
@endsection
