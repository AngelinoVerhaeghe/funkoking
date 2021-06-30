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
                        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around">
        <div class="col-6 mb-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title pt-1">Create Product:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.form_error')
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminProductsController@store', 'files' => true]) !!}
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group w-25">
                            {!! Form::label('category_id', 'Category:') !!}
                            {!! Form::select('category_id', ['' => 'Choose'] + $categories, null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-25">
                            {!! Form::label('subcategory_id', 'Sub Category:') !!}
                            {!! Form::select('subcategory_id', ['' => 'Choose'] + $subcategories, null, ['class' => 'form-control rounded-0']) !!}
                        </div>
                        <div class="form-group w-25 pt-3">
                            {!! Form::label('price', 'Price:') !!}
                            {{--{!! Form::text('price', null, ['class' => 'form-control <i class="fas fa-euro-sign></i>', 'type' => 'number', 'step' => '0.01']) !!}--}}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text rounded-0"><i class="fas fa-euro-sign"></i></div>
                                </div>
                                <input type="number" name="price" class="form-control rounded-0" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="form-group w-50">
                            {!! Form::label('photo_id', 'Product Photo:') !!}
                            {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image_1', 'onchange' => 'putImage()']) !!}
                        </div>
                        {{--<div class="form-group w-50">
                            {!! Form::label('photo2_id', 'Product Photo 2:') !!}
                            {!! Form::file('photo2_id', ['class' => 'form-control-file', 'id' => 'select_image_2', 'onchange' => 'putImage_2()']) !!}
                        </div>--}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Product Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', 'Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'SubTitle:') !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group mr-3">
                            {!! Form::submit('Create Product', ['class' => 'btn btn-info rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('products.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Photo{{--{{$product->photo_id}}--}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('products.create')}}" class="btn btn-info">Create Product</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img id="target" height="350" width="350"
                             src="http://place-hold.it/350x350?text=Select Product Image" {{--{{$product->photo ? asset($product->photo->file) : 'http://place-hold.it/400x400'}}--}}
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
            var src = document.getElementById("select_image_1");
            var target = document.getElementById("target");
            showImage(src, target);
        }

        function putImage_2() {
            var src = document.getElementById("select_image_2");
            var target_2 = document.getElementById("target_2");
            showImage(src, target_2);
        }
    </script>
@endsection
{{--@section('ck-editor')
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: ['heading', '|', 'bold', 'italic', 'blockQuote']
            })
            .then( editor => {
                window.editor = editor;
            })
            .catch( error => {
                console.error( 'There was a problem initializing the editor.', error );
            });
    </script>
@endsection--}}
