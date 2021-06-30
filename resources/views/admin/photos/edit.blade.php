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
                        <li class="breadcrumb-item"><a href="{{route('photos.index')}}">Photos</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around mt-4">
        <div class="col-6 mb-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Edit Photo:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($photo, ['method' => 'PATCH', 'action' => ['AdminPhotosController@update', $photo->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name', ' Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group mt-3">
                        {!! Form::label('file', ' Filename:') !!}
                        {!! Form::text('file', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-warning mr-3 rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('photos.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Photo:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid" src="{{$photo->file ? asset('images/products/' . $photo->file) : 'http://place-hold.it/400x400'}}" alt="Photo">
                    </div>
                    <p class="d-flex justify-content-center">{{$photo->name}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
