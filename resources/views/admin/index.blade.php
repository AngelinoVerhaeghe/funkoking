@extends('layouts.admin')
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card card-dark shadow">
                <div class="card-header">
                    <h3 class="card-title"><span class="badge badge-light shadow">New</span> Users</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @if($users)
                            @foreach($users as $user)
                                <li>
                                    <img class="img-circle shadow" height="60" width="60"
                                         src="{{ $user->photo ? asset('images/' . $user->photo->file) : 'http://place-hold.it/60x60?text=' }}"
                                         alt="User Image">
                                    <p class="users-list-name m-0">{{ $user->name }}</p>
                                    <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('users.index')}}">View All Users</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-dark shadow">
                <div class="card-header">
                    <h3 class="card-title"><span class="badge badge-light shadow">New</span> Products</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @if($products)
                            @foreach($products as $product)
                                <li>
                                    <img class="shadow" height="60" width="60"
                                         src="{{ $product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/70x70?text=' }}"
                                         alt="Product Image">
                                    <a href="{{route('products.index')}}" class="users-list-name m-0">{{ $product->name }}</a>
                                    <span class="users-list-date">{{ $product->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('products.index')}}">View All Products</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card card-danger shadow">
                <div class="card-header">
                    <h3 class="card-title">Evaluation</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-cyan shadow">
                <div class="card-header">
                    <h3 class="card-title">Studiejaar: 2019 - 2020</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://placehold.it/700x230/6610f2/ffffff&amp;text=Eindwerk+Angelino+Verhaeghe"
                                     alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://placehold.it/700x230/3c8dbc/ffffff&amp;text=Funko+King+Webshop+Backend"
                                     alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://placehold.it/700x230/d81b60/ffffff&amp;text=Full+Stack+Developer+SyntraWest"
                                     alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('pie-script')
    <script>
        window.onload = function () {
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Users',
                    'Products',
                    'Orders',
                    'Stocks',
                ],
                datasets: [
                    {
                        data: [
                            /*700,500,400,600,300,100*/
                            [{{ session('usersCount') }}],
                            [{{ session('productCount') }}],
                            [{{ session('ordersCount') }}],
                            [{{ session('stocksCount') }}],
                        ],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            }
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

        };
    </script>
@endsection
