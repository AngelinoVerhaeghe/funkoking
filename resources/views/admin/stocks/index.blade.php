@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Stocks</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Stocks</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Stocks:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="d-flex justify-content-end">
                    @if(Session::has('deleted_stock'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('deleted_stock')}}
                        </div>
                    @elseif(Session::has('created_stock'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('created_stock')}}
                        </div>
                    @elseif(Session::has('updated_stock'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_stock')}}
                        </div>
                    @elseif(Session::has('softdeleted_stock'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{session('softdeleted_stock')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($stocks)
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{$stock->id}}</td>
                            <td>
                                <img height="62" width="62"
                                     src="{{$stock->photo ? asset('images/' . $stock->photo->file) : 'http://place-hold.it/62x62'}}"
                                     alt="Product Picture">
                            </td>
                            <td>{{$stock->product->name}}</td>
                            <td>{{$stock->quantity}}</td>
                            <td>
                                @if($stocks)
                                    @if($stock->quantity > 5)
                                        <span class="badge badge-success shadow">Op Voorraad</span>
                                    @elseif($stock->quantity >= 1)
                                        <span class="badge badge-warning shadow">Bestellen</span>
                                    @elseif($stock->quantity <= 0)
                                        <span class="badge badge-danger shadow">Uit Voorraad</span>
                                    @endif
                                @endif
                            </td>
                            <td>{{$stock->created_at}}</td>
                            <td>{{$stock->updated_at}}</td>
                            <td class="d-flex align-items-center justify-content-around">
                                {{--<a class="btn btn-sm bg-primary text-white p-1 px-3 rounded-0" href="{{route('stocks.edit', $stock->id)}}"><i
                                        class="fas fa-edit"></i></a>--}}
                                <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-stock_id="{{ $stock->id }}"
                                        data-product_id="{{ $stock->product_id }}"
                                        data-quantity="{{ $stock->quantity }}" data-photo_id="{{ $stock->photo_id }}" data-toggle="modal"
                                        data-target="#editStock">Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Stock-->
    <div class="modal fade" id="editStock" tabindex="-1" role="dialog" aria-labelledby="editStockCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="editStockLongTitle">Edit Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('stocks.update', 'update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="stock_id" id="stock_id" value="">
                        <div class="form-group">
                            {!! Form::label('quantity', 'Input New Quantity:') !!}
                            {!! Form::number('quantity', null, ['class' => 'form-control', 'min' => '0']) !!}
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
    <!-- End Modal Edit Stock-->

@endsection
@section('edit-delete-script')
    <script>
        $('#editStock').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let stock_id = button.data('stock_id') // Extract info from data-* attributes
            let quantity = button.data('quantity') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #stock_id').val(stock_id)
            modal.find('.modal-body #quantity').val(quantity)
        })
    </script>
@endsection
@section('image-script')
    <script>
        function showEditImage(src, targetEdit) {
            var fredit = new FileReader();

            fredit.onload = function () {
                targetEdit.src = fredit.result;
            }
            fredit.readAsDataURL(src.files[0]);

        }

        function putImageEdit() {
            var src = document.getElementById("select_image_edit");
            var targetEdit = document.getElementById("targetEdit");
            showEditImage(src, targetEdit);
        }
    </script>
    <!--Alert fade script-->
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert").alert('close');
            }, 2000);
        });
    </script>
@endsection
