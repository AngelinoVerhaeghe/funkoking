@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0">Product Info</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">Products Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- Profile Image -->
                <div class="card card-warning card-outline shadow">
                    <div class="card-body">
                        <h3>Product: {{ $product->name }}</h3>
                        <div class="d-flex justify-content-around mt-4">
                        <div class="col-4 callout callout-success">
                            <img class="img-fluid" src="{{ asset('images/' . $product->photo->file) }}" alt="Product Image">
                        </div>
                        <div class="col-6">
                            <h4 class="mb-4">Details:</h4>
                            <p class="lead">{{ $product->title }}</p>
                            <p class="lead">{{ $product->subtitle }}</p>
                            <p class="lead">{{ $product->description }}</p>
                            <p class="lead"><strong>{{ $product->price }} €</strong></p>
                            <div class="row justify-content-end">
                                <a class="btn btn-secondary shadow" href="{{ route('products.index') }}">Back</a>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-warning card-outline shadow">
                    <div class="card-body ">
                        <h5 class="mb-3">Totals:</h5>
                        <div class="callout callout-warning">
                            <b>Reviews</b> <a class="float-right">8</a>{{--Link naar reviews nog!--}}
                        </div>
                        <div class="callout callout-info">
                            <b>Total Orders</b> <a class="float-right">12</a>{{--Link naar orders!--}}
                        </div>
                        <div class="callout callout-success">
                            <b>Total in Stock</b> <a class="float-right">20</a>{{--Link naar stock hoeveelheid!--}}
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </div>
    </div>
@endsection
