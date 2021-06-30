@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-8 offset-2 mb-4">
            <div class="card shadow p-3 mt-4">
                <h2 class="text-dark mb-4"><u>Upload Photo:</u></h2>
                {!! Form::open(['method' => 'POST', 'action' => 'AdminPhotosController@store', 'class' => 'dropzone']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
@endsection
