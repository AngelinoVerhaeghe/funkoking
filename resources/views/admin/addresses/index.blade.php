@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Addresses</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Addresses</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Addresses:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-end">
                    @if(Session::has('deleted_address'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('deleted_address')}}
                        </div>
                    @elseif(Session::has('created_address'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('created_address')}}
                        </div>
                    @elseif(Session::has('updated_address'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_address')}}
                        </div>
                    @elseif(Session::has('softdeleted_address'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('softdeleted_address')}}
                        </div>
                    @endif
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Street</th>
                    <th>Number</th>
                    <th>PostalCode</th>
                    <th>PostBox</th>
                    <th>City</th>
                    <th>Country</th>
                    {{-- <th class="sorting">Created</th>
                     <th class="sorting">Updated</th>--}}
                   {{-- <th>Edit</th>
                    <th>Status</th>--}}
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( $addresses )
                    @foreach( $addresses as $address )
                        <tr>
                            <td>{{ $address->id }}</td>
                            <td>{{ $address->user->name }}</td>
                            <td>{{ $address->street }}</td>
                            <td>{{ $address->number }}</td>
                            <td>{{ $address->postalcode }}</td>
                            <td>{{ $address->postbox }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->country }}</td>
                            {{-- <td>{{$address->created_at}}</td>
                             <td>{{$address->updated_at}}</td>--}}
                            <td class="d-flex align-items-center justify-content-around">
                                <div>
                                <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-street="{{ $address->street }}" data-number="{{ $address->number }}" data-postalcode="{{ $address->postalcode }}"
                                        data-city="{{ $address->city }}" data-country="{{ $address->country }}" data-address_id="{{ $address->id }}" data-toggle="modal" data-target="#editAddress">Edit</button>
                                </div>

                                @if( $address->deleted_at != NULL )
                                    <a class="btn btn-xs bg-danger text-white p-1 px-2 shadow" href="{{ route('admin.addressrestore', $address->id )}}">Not Active</a>
                                @else
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminAddressController@destroy', $address->id]]) !!}
                                    <div>
                                        {!! Form::button('Active', ['type' => 'submit', 'class' => 'btn btn-xs btn-success p-1 px-2 shadow']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Edit Address-->
    <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="editAddressCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="editAddressLongTitle">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('addresses.update', 'update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="address_id" id="address_id" value="">
                        <div class="d-flex">
                            <div class="form-group w-75 pr-3">
                                {!! Form::label('street', 'Street:') !!}
                                {!! Form::text('street', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group w-25">
                                {!! Form::label('number', 'Number:') !!}
                                {!! Form::text('number', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group w-25">
                                {!! Form::label('postalcode', 'Postalcode:') !!}
                                {!! Form::text('postalcode', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group w-50 px-3">
                                {!! Form::label('city', 'City:') !!}
                                {!! Form::text('city', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group w-25">
                                {!! Form::label('postbox', 'Postbox:') !!}
                                {!! Form::text('postbox', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group w-75">
                            {!! Form::label('country', 'Country:') !!}
                            {!! Form::text('country', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-warning shadow">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Edit Category-->

@endsection
@section('edit-delete-script')
    <script>
        $('#editAddress').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let street = button.data('street') // Extract info from data-* attributes
            let number = button.data('number') // Extract info from data-* attributes
            let postalcode = button.data('postalcode') // Extract info from data-* attributes
            let city = button.data('city') // Extract info from data-* attributes
            let country = button.data('country') // Extract info from data-* attributes
            let address_id = button.data('address_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #street').val(street)
            modal.find('.modal-body #number').val(number)
            modal.find('.modal-body #postalcode').val(postalcode)
            modal.find('.modal-body #city').val(city)
            modal.find('.modal-body #country').val(country)
            modal.find('.modal-body #address_id').val(address_id)
        })
    </script>
@endsection
@section('image-script')
    <!--Alert fade script-->
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert").alert('close');
            }, 2000);
        });
    </script>
@endsection
