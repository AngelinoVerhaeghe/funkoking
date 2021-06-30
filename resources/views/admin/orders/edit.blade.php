@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card shadow p-3">
                <h2 class="text-dark"><u>Edit Order:</u></h2>
                {!! Form::model($order, ['method' => 'PATCH', 'action' => ['AdminOrdersController@update', $order->id]]) !!}
                <div class="form-group w-25 mr-3">
                    {!! Form::label('status_id', 'Order Status:') !!}
                    {!! Form::select('status_id', ['' => 'Choose'] + $orderstatus, null, ['class' => 'form-control']) !!}
                </div>
                <div class="d-flex">
                    <div class="form-group">
                        {!! Form::submit('Update Order', ['class' => 'btn btn-dark rounded-0 mr-3']) !!}
                    </div>
                    <div class="form-group">
                        <a class="btn bg-dark text-white rounded-0" href="{{route('orders.index')}}"><i
                                class="fas fa-arrow-alt-circle-left mr-2"></i>Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
