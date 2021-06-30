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
                        <li class="breadcrumb-item"><a href="{{route('reviews.index')}}">Reviews</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around mt-5">
        <div class="col-6">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Edit Review:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('products.create')}}" class="btn btn-info">Create Product</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($review, ['method' => 'PATCH', 'action' => ['AdminReviewsController@update', $review->id], 'files' => true]) !!}
                    {{-- <div class="d-flex align-items-center">
                         <div class="form-group w-25 mr-3">
                             {!! Form::label('category_id', 'Category:') !!}
                             {!! Form::select('category_id', ['' => 'Choose'] + $categories, null, ['class' => 'form-control']) !!}
                         </div>
                         <div class="form-group w-25 mr-3">
                             {!! Form::label('subcategory_id', 'Sub Category:') !!}
                             {!! Form::select('subcategory_id', ['' => 'Choose'] + $subcategories, null, ['class' => 'form-control']) !!}
                         </div>
                         <div class="form-group w-25">
                             {!! Form::label('price', 'Price:') !!}
                             {!! Form::text('price', null, ['class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="d-flex align-items-center">
                         <div class="form-group w-50 pr-3">
                             {!! Form::label('photo_id', 'Product Photo:') !!}
                             {!! Form::file('photo_id', ['class' => 'form-control-file']) !!}
                         </div>
                         <div class="form-group w-25 mr-3">
                             {!! Form::label('photo_id', 'Select Photo:') !!}
                             {!! Form::select('photo_id', ['' => 'Choose'] + $photos, null, ['class' => 'form-control']) !!}
                         </div>
                     </div>--}}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', $review->user->name, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', $review->user->email, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    {{-- <div class="form-group">
                         {!! Form::label('subtitle', 'SubTitle:') !!}
                         {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                     </div>--}}
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control rounded-0', 'rows' => 3]) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-warning mr-3 rounded-0']) !!}
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
                    <h3 class="card-title mt-2">Photo: {{$review->product->photo_id}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--<a href="{{route('products.create')}}" class="btn btn-info">Create Product</a>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img height="400" width="400" src="{{$review->product->photo ? asset($review->product->photo->file) : 'http://place-hold.it/400x400?text=No Image'}}"
                             alt="Product Picture">
                    </div>
                </div>
                <p class="d-flex justify-content-center text-bold">{{$review->product->photo->name}}</p>
            </div>
        </div>
    </div>
@endsection
