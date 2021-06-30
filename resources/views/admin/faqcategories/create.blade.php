@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-8 offset-2 mb-4">
            <div class="card shadow p-3 mt-5">
                <h2 class="text-dark"><u>Create FAQ Category:</u></h2>
                @include('includes.form_error')
                {!! Form::open(['method' => 'POST', 'action' => 'AdminFaqsCategoriesController@store']) !!}
                <div class="form-group mt-3">
                    {!! Form::label('name', 'FAQ Category Name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="d-flex">
                    <div class="form-group mr-3">
                        {!! Form::submit('Create FAQ Category', ['class' => 'btn btn-dark rounded-0']) !!}
                    </div>
                    <div class="form-group">
                        <a class="btn bg-dark text-white rounded-0" href="{{route('faqcategories.index')}}"><i
                                class="fas fa-arrow-alt-circle-left mr-2"></i>Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
