@extends('layouts.frontend')
@section('content')
    <section id="breadcrumb-nav" class="row">
        <div class="col-lg-8 offset-lg-2">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-lg-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Betaling aanvaard!</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="account">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 card rounded-0 shadow my-5">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h3>Bedankt voor uw aankoop!</h3>
                        </div>
                        <hr>
                        <div class="card-body text-center">
                            @if(Session::has('success'))
                                <div class="alert alert-success fade show text-center shadow" role="alert">
                                    {{session('success')}}
                                </div>
                            @endif
                                <div class="row justify-content-end">
                                    <a href="{{ route('index') }}" class="btn btn-success rounded-0 my-3" style="background-color: #3cb878">Terug</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
