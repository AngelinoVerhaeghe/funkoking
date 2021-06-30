@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('addresses.index')}}">Addresses</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title pt-1">Create Address:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.form_error')
                    @if(Session::has('created_address'))
                        <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{session('created_address')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminAddressController@store']) !!}
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        {{-- {!! Form::label('user_id', 'Name:') !!}
                         {!! Form::text('user_id', $user->id, ['class' => 'form-control']) !!}--}}
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-75">
                            {!! Form::label('street', 'Street:') !!}
                            {!! Form::text('street', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group mx-3">
                            {!! Form::label('number', 'Number:') !!}
                            {!! Form::text('number', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('postbox', 'Postbox:') !!}
                            {!! Form::text('postbox', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group mr-3">
                            {!! Form::label('postalcode', 'Postal Code:') !!}
                            {!! Form::text('postalcode', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-75">
                            {!! Form::label('city', 'City:') !!}
                            {!! Form::text('city', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                    </div>
                    <div class="form-group w-50">
                        {!! Form::label('country', 'Country:') !!}
                        {!! Form::text('country', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group mr-3">
                        {!! Form::submit('Create', ['class' => 'btn btn-info rounded-0']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
