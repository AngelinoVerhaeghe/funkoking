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
                        <li class="breadcrumb-item active">Edit</li>
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
                    <h3 class="card-title mt-2">Edit Address:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($address, ['method' => 'PATCH', 'action' => ['AdminAddressController@update', $address->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        <br>
                        {{$address->user->name}}
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50 mr-2">
                            {!! Form::label('street', 'Street:') !!}
                            {!! Form::text('street', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-25 mr-2">
                            {!! Form::label('number', 'Number:') !!}
                            {!! Form::text('number', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-25">
                            {!! Form::label('postalbox', 'PostalBox:') !!}
                            {!! Form::text('postalbox', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-25 mr-2">
                            {!! Form::label('postalcode', 'PostalCode:') !!}
                            {!! Form::text('postalcode', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-75">
                            {!! Form::label('city', 'City:') !!}
                            {!! Form::text('city', null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('country', 'Country:') !!}
                        {!! Form::text('country', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-warning mr-3 rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('addresses.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
