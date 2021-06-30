@extends('layouts.admin')
@section('content-header')
    <div class="content-header">
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
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around mt-5">
        <div class="col-6 mb-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title pt-1">Create User:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.form_error')
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
                    <div class="d-flex">
                        <div class="form-group w-25 mr-4">
                            {!! Form::label('Select Roles:') !!}
                            {!! Form::select('roles[]', $roles, null, ['class' => 'form-control rounded-0', 'multiple' => 'multiple']) !!}
                        </div>
                        <div class="form-group w-50">
                            {!! Form::label('photo_id', 'User Photo:') !!}
                            {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group mr-3">
                            {!! Form::submit('Create User', ['class' => 'btn btn-info rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('users.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Photo {{--{{$product->photo_id}}--}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('products.create')}}" class="btn btn-info">Create Product</a>--}}
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img id="target" height="400" width="400"
                             src="http://place-hold.it/400x400?text=Select User Image" {{--{{$product->photo ? asset($product->photo->file) : 'http://place-hold.it/400x400'}}--}}
                             alt="Product Picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('image-script')
    <script>
        function showImage(src, target) {
            var fr = new FileReader();

            fr.onload = function () {
                target.src = fr.result;
            }
            fr.readAsDataURL(src.files[0]);

        }

        function putImage() {
            var src = document.getElementById("select_image");
            var target = document.getElementById("target");
            showImage(src, target);
        }
    </script>
@endsection
