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
                        <li class="breadcrumb-item"><a href="{{route('faqs.index')}}">FAQ's</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-1"></div>
        <div class="col-6 mb-4">
            <div class="card card-dark shadow">
                <div class="card-header rounded-0">
                    <h3 class="card-title mt-2">Create FAQ:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        {{--  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.form_error')
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminFaqsController@store']) !!}
                    <div class="form-group w-25">
                        {!! Form::label('faq_category_id', 'Category:') !!}
                        {!! Form::select('faq_category_id', ['' => 'Choose'] + $faqcategories, null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group mt-3">
                        {!! Form::label('question', 'Question:') !!}
                        {!! Form::text('question', null, ['class' => 'form-control rounded-0']) !!}
                    </div>
                    <div class="form-group mt-3">
                        {!! Form::label('answer', 'Answer:') !!}
                        {!! Form::textarea('answer', null, ['class' => 'form-control rounded-0', 'rows' => 3]) !!}
                    </div>
                    <div class="d-flex">
                        <div class="form-group mr-3">
                            {!! Form::submit('Create', ['class' => 'btn btn-info rounded-0']) !!}
                        </div>
                        <div class="form-group">
                            <a class="btn bg-dark text-white rounded-0" href="{{route('faqs.index')}}">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
