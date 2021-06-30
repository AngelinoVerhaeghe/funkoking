@extends('layouts.frontend')
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2 p-0">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog-Content</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="blog-content" class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-12 card p-3 my-5 shadow-lg">
                    <div class="d-flex justify-content-around">
                        <div>
                            <img height="350" src="{{ asset('images/' . $blog->photo->file) }}" alt="Blog Picture">
                        </div>
                        <div class="align-items-center p-4">
                            <h5 class="card-title text-center">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->description }}</p>
                            <footer class="blockquote-footer">
                                {{ $blog->user->name }}
                                <cite title="Source Title" class="d-flex justify-content-end">{{ $blog->created_at->diffForHumans() }}</cite>

                            </footer>
                            <div class="row justify-content-end">
                                <a href="{{ route('blog') }}" class="btn btn-success rounded-0 my-3" style="background-color: #3cb878">Terug</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
