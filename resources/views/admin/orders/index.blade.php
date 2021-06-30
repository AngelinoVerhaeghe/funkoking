@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Orders</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Orders:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-end">
                    @if(Session::has('deleted_order'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('deleted_order')}}
                        </div>
                    @elseif(Session::has('created_order'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('created_order')}}
                        </div>
                    @elseif(Session::has('updated_order'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_order')}}
                        </div>
                    @elseif(Session::has('softdeleted_order'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('softdeleted_order')}}
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Photo</th>
                    <th>Total Price</th>
                    <th>Token</th>
                    <th>Created</th>
                    <th>Updated</th>
                    {{--<th>Edit</th>
                    <th>Delete</th>--}}
                    {{--<th>Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                @if($orders)
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>
                                <img height="50" width="50" class="img-thumbnail shadow"
                                     src="{{ $order->photo ? asset('images/' . $order->photo) : 'http://place-hold.it/40x40?text=.'}}"
                                     alt="Product Picture">
                            </td>
                            <td>{{$order->total_price}} €</td>
                            <td>{{$order->payment_token}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->updated_at}}</td>
                            {{--<td class="d-flex align-items-center justify-content-around">
                                <div>
                                <a class="btn btn-xs bg-primary text-white p-1 px-2 shadow" href="{{route('orders.edit', $order->id)}}">Edit</a>
                                </div>
                                @if($order->deleted_at != NULL)
                                    <a class="btn btn-xs bg-danger text-white p-1 px-2 shadow" href="{{route('admin.orderrestore', $order->id)}}">Not Active</a>
                                @else
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminOrdersController@destroy', $order->id]]) !!}
                                    <div>
                                        {!! Form::button('Active', ['type' => 'submit', 'class' => 'btn btn-xs btn-success p-1 px-2 shadow']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
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
