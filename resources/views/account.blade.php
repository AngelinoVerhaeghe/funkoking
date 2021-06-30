@extends('layouts.frontend')
@section('title')
    Funko King | Account
@endsection
@section('content')
    <section id="account">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="card rounded-0 shadow my-5">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Account:</h3>
                    </div>
                    <hr>
                    <div class="row d-sm-flex">
                        <div class="col-12 col-lg-5 p-3">
                            @if(Session::has('updated_user'))
                                <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{session('updated_user')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                                <div class="mb-2">
                                    @if(Auth::user()->photo_id != '')
                                        <img id="target" class="img-thumbnail shadow" height="150" width="150"
                                             src="{{ Auth::user()->photo ? asset('images/' . Auth::user()->photo->file) : 'http://place-hold.it/150x150?text=Foto' }}"
                                             alt="User Picture">
                                    @else
                                        <img id="target" class="img-thumbnail" height="150" width="150" src="http://place-hold.it/150x150?text=Foto" alt="User Picture">
                                    @endif
                                </div>
                            {!! Form::open(['method' => 'PATCH', 'action' => ['PagesController@updateAccount', Auth::user()] , 'files' => true]) !!}
                            <div class="d-flex">
                                <div class="form-group">
                                    {!! Form::label('photo_id', 'Foto:') !!}
                                    {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Naam:') !!}
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control rounded-0']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control rounded-0']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Paswoord: (Indien je het wenst te wijzigen).') !!}
                                {!! Form::password('password', ['class' => 'form-control rounded-0']) !!}
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    {!! Form::submit('Opslaan', ['class' => 'btn btn-warning mr-3 rounded-0 btn-continue', ]) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 border-left p-3">
                            <h3 class="mb-4">Adresgegevens:</h3>
                            @if(Session::has('created_address'))
                                <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{session('created_address')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @elseif(Session::has('address_updated'))
                                    <div class="col-12 alert alert-success alert-dismissible fade show text-center" role="alert">
                                        {{session('address_updated')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            @endif
                            @if(Auth::user()->address_id != '')
                               {{--{!! Form::open(['method' => 'PATCH', 'action' => ['PagesController@updateAddress', Auth::user()]]) !!}--}}
                                <form method="post" action="{{ route('update.address', 'update') }}">
                                    @csrf
                                   @method('PATCH')
                               <input type="hidden" name="address_id" id="address_id" value="{{ Auth::user()->address->id }}">
                                <div class="d-flex">
                                    <div class="form-group w-75 pr-2">
                                        {!! Form::label('street', 'Straatnaam:') !!}
                                        {!! Form::text('street', Auth::user()->address->street, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-25">
                                        {!! Form::label('number', 'Nummer:') !!}
                                        {!! Form::text('number', Auth::user()->address->number, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group w-25">
                                        {!! Form::label('postalcode', 'Postcode:') !!}
                                        {!! Form::text('postalcode', Auth::user()->address->postalcode, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-75 px-2">
                                        {!! Form::label('city', 'Plaats:') !!}
                                        {!! Form::text('city', Auth::user()->address->city, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-25">
                                        {!! Form::label('postbox', 'Postbus:') !!}
                                        {!! Form::text('postbox', Auth::user()->address->postbox, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group w-75">
                                    {!! Form::label('country', 'Land:') !!}
                                    {!! Form::text('country', Auth::user()->address->country, ['class' => 'form-control rounded-0', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Update', ['class' => 'btn btn-warning mr-3 rounded-0 btn-continue']) !!}
                                </div>
                               {{--{!! Form::close() !!}--}}
                                </form>
                            @else
                                {!! Form::open(['method' => 'POST', 'action' => 'PagesController@accountNewAddress']) !!}
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                <div class="d-flex">
                                    <div class="form-group w-75 pr-2">
                                        {!! Form::label('street', 'Straatnaam:') !!}
                                        {!! Form::text('street', null, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-25">
                                        {!! Form::label('number', 'Nummer:') !!}
                                        {!! Form::text('number', null, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group w-25">
                                        {!! Form::label('postalcode', 'Postcode:') !!}
                                        {!! Form::text('postalcode', null, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-75 px-2">
                                        {!! Form::label('city', 'Plaats:') !!}
                                        {!! Form::text('city', null, ['class' => 'form-control rounded-0', 'required']) !!}
                                    </div>
                                    <div class="form-group w-25">
                                        {!! Form::label('postbox', 'Postbus:') !!}
                                        {!! Form::text('postbox', null, ['class' => 'form-control rounded-0']) !!}
                                    </div>
                                </div>
                                <div class="form-group w-75">
                                    {!! Form::label('country', 'Land:') !!}
                                    {!! Form::text('country', null, ['class' => 'form-control rounded-0', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Adres Opslaan', ['class' => 'btn btn-warning mr-3 rounded-0 btn-continue']) !!}
                                </div>
                                {!! Form::close() !!}
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <a class="btn btn-primary rounded-0 btn-back" href="{{ route('index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
