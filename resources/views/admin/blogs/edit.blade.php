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
                        <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Blog</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-3">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Photo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img height="300" width="300" src="{{$blog->photo ? asset('images/' . $blog->photo->file) : 'http://place-hold.it/300x300'}}"
                             alt="Blog Picture">
                    </div>
                    <p class="d-flex justify-content-center text-bold">{{$blog->photo->name}}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Edit Blog:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}
                        {{--  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($blog, ['method' => 'PATCH', 'action' => ['AdminBlogsController@update', $blog->id], 'files' => true]) !!}
                    <div class="d-flex align-items-center">
                        <div class="form-group w-50 mr-3">
                            {!! Form::label('blog_category_id', 'Category:') !!}
                            {!! Form::select('blog_category_id', ['' => 'Choose'] + $blogCategories, null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                       {{-- <div class="form-group w-50">
                            {!! Form::label('photo_id', 'Select Photo:') !!}
                            {!! Form::select('photo_id', ['' => 'Choose'] + $photos, null, ['class' => 'form-control rounded-0', 'id' => 'select_image_2', 'onchange' => 'putImage_2()']) !!}
                        </div>--}}
                    </div>
                    <div class="form-group w-50">
                        {!! Form::label('photo_id', 'Blog Photo:') !!}
                        {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', 'Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control rounded-0', 'rows' => 3]) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-warning mr-3 rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('blogs.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">New Photo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('products.create')}}" class="btn btn-info">Create Product</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body my-3">
                    <div class="d-flex justify-content-center">
                        <img id="target" height="400" width="400" class="target_2"
                             src="http://place-hold.it/300x300?text=Select Blog Image"
                             {{--{{$product->photo ? asset($product->photo->file) : 'http://place-hold.it/400x400'}}--}}
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

