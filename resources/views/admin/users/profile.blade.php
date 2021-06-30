@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Profile</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-7">
                    <div class="card card-primary card-outline shadow">
                        <div class="d-flex card-body box-profile">
                            <div class="col-6">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ $user->photo ? asset('images/' . $user->photo->file) : 'http://place-hold.it/60x60?text=.' }}"
                                         alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <p class="text-muted text-center">{{ $user->created_at->diffForHumans() }}</p>
                                <div class="text-center">
                                    @foreach($user->roles as $role)
                                        @if($role->name == 'Administrator')
                                            <span class="badge badge-info shadow">{{ $role->name }}</span>
                                        @elseif($role->name == 'Buyer')
                                            <span class="badge badge-warning shadow">{{ $role->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                                <hr>
                                <div class="callout callout-warning">
                                  {{-- @if( Auth::user()->id == $user->review['user_id'])--}}
                                    <b>Reviews:</b> <a class="float-right">{{ $review->count() }}</a>
                                      {{-- @endif--}}
                                </div>
                                <div class="callout callout-info">
                                    <b>Orders:</b> <a class="float-right">{{ $orders->count() }}</a>
                                </div>
                                <div class="callout callout-success">
                                    <b>Total Payments:</b> <a class="float-right">{{--{{ $orders->total_price }}--}} €</a>
                                </div>
                            </div>
                            <div class="col-6 card card-danger card-outline">
                                @if( $user->address_id != '')
                                    <div class="card-body">
                                        <h3>Address:</h3>
                                        <hr>
                                        <p><strong>Street: </strong>{{ $user->address->street . ' ' . $user->address->number }} </p>
                                        <p><strong>Postcode | City: </strong>{{ $user->address->postalcode . ' ' . $user->address->city }} </p>
                                        <p><strong>Country: </strong>{{ $user->address->country }} </p>
                                        <hr>
                                        <div class="row justify-content-end">
                                            <a class="btn btn-secondary shadow" href="{{ route('users.index') }}">Back</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <h3>Address:</h3>
                                        <hr>
                                        <p><strong>Street: </strong></p>
                                        <p><strong>Postcode | City: </strong></p>
                                        <p><strong>Country: </strong></p>
                                        <hr>
                                        <div class="row justify-content-end">
                                            <a class="btn btn-secondary shadow" href="{{ route('users.index') }}">Back</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
