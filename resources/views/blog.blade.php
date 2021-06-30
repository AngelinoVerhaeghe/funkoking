@extends('layouts.frontend')
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2 p-0">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="blog-content" class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="col-12 jumbotron justify-content-center my-4 rounded-0 shadow">
                <h1 class="display-4 text-center text-sm-left">Funko <span>King</span></h1>
                <p class="lead text-center text-sm-left">Ben jij een echte verzamelaar? Dan zit je bij Funko King op het juiste adres! Er komen
                    regelmatig nieuwe Pop!
                    figuren in
                    onze webshop!</p>
                <hr class="line my-4">
                <p class="text-center text-sm-left">Populaire Pops zijn onder andere van Disney, Marvel, DC Comics, Star Wars, The Walking Dead, Game
                    of Thrones, Harry Potter en
                    nog veel meer!</p>
                <div class="d-flex justify-content-center justify-content-sm-start"><a class="btn btn-primary btn-lg" href="{{route('shop')}}"
                                                                                       role="button">Webshop</a></div>
            </div>
            <div class="row">
            @foreach($blogs as $blog)
                <div class="col-6 mb-3">
                    <div class="card p-2 h-100 rounded-0 shadow">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <img height="200" width="200"
                                     src="{{ $blog->photo ? asset('images/' . $blog->photo->file) : 'http://place-hold.it/200x200' }}"
                                     alt="{{ $blog->title }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text short-lines">{{ Str::limit($blog->description, 120, ' (...)') }}</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-primary">Lees meer...</a>
                                    <p class="m-0"><cite title="Source Title">{{ $blog->blogcategory->name }}</cite></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>
@endsection
