@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0">Products</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Products:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createProduct">
                    <i class="fas fa-plus mr-3"></i>Create
                </button>
            </div>
            <div class="row">
                <div class="col-8 offset-2 d-flex justify-content-center">
                    @if(Session::has('deleted_product'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('deleted_product')}}
                        </div>
                    @elseif(Session::has('created_product'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('created_product')}}
                        </div>
                    @elseif(Session::has('updated_product'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_product')}}
                        </div>
                    @elseif(Session::has('softdeleted_product'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('softdeleted_product')}}
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                {{--<a href="{{route('products.create')}}" class="btn btn-info mb-3 rounded-0">Create Product</a>--}}
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Product</th>
                    <th>Title</th>
                    {{--<th>SubTitle</th>--}}
                    <th>Description</th>
                    <th>Price</th>
                    {{-- <th class="sorting">Created</th>
                     <th class="sorting">Updated</th>--}}
                    {{-- <th>Edit</th>
                     <th>Status</th>--}}
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( $products )
                    @foreach( $products as $product )
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img height="62" width="62"
                                     src="{{ $product->photo ? asset('images/' . $product->photo->file) : 'http://place-hold.it/62x62' }}"
                                     alt="Product Picture">
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->subcategory->name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->title }}</td>
                            {{--<td>{{$product->subtitle}}</td>--}}
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} €</td>
                            {{-- <td>{{$product->created_at}}</td>
                             <td>{{$product->updated_at}}</td>--}}
                            <td class="d-flex align-items-center justify-content-around mx-3">
                                <div class="mr-2">
                                    <a class="btn btn-xs bg-secondary text-white p-1 px-2 shadow" href="{{ route('info', $product->id) }}">Info</a>
                                </div>
                                <div class="mr-2">
                                    <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-product_id="{{ $product->id }}"
                                            data-name="{{ $product->name }}" data-title="{{ $product->title }}"
                                            data-category_id="{{ $product->category->id }}" data-subcategory_id="{{ $product->subcategory->id }}"
                                            data-subtitle="{{ $product->subtitle }}" data-description="{{ $product->description }}"
                                            data-price="{{ $product->price }}" data-photo_id="{{ $product->photo_id }}" data-toggle="modal" data-target="#editProduct">Edit
                                    </button>
                                </div>
                                @if( $product->deleted_at != NULL )
                                    <a class="btn btn-xs bg-danger text-white p-1 px-2 shadow" href="{{ route('admin.productrestore', $product->id) }}">Not Active</a>
                                @else
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminProductsController@destroy', $product->id]]) !!}
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

    <!-- Modal Create Product-->
    {{--<create-product></create-product>--}}
    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="createProductCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="createProductLongTitle">Create Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' => 'POST', 'action' => 'AdminProductsController@store', 'files' => true]) !!}
                <div class="modal-body">
                    @include('includes.form_error')
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group w-25">
                            {!! Form::label('Category:') !!}
                            {!! Form::select('category_id', ['' => 'Choose'] + $categories, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group w-25">
                            {!! Form::label('Sub Category:') !!}
                            {!! Form::select('subcategory_id', ['' => 'Choose'] + $subcategories, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group w-25 pt-3">
                            {!! Form::label('Price:') !!}
                            {{--{!! Form::text('price', null, ['class' => 'form-control <i class="fas fa-euro-sign></i>', 'type' => 'number', 'step' => '0.01']) !!}--}}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-euro-sign"></i></div>
                                </div>
                                <input type="number" name="price" class="form-control" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group w-50">
                            {!! Form::label('Product Photo:') !!}
                            {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()', 'required']) !!}
                        </div>
                        <div class="d-flex justify-content-center">
                            <img id="target" class="img-thumbnail" height="150" width="150"
                                 src="http://place-hold.it/150x150?text=Select Product Image" alt="Product Picture">
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Product Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('SubTitle:') !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-info shadow">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Edit Product-->
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editProductCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="editProductLongTitle">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('products.update', 'update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-group w-25">
                                {!! Form::label('category_id', 'Category:') !!}
                                {!! Form::select('category_id', ['' => 'Choose'] + $categories, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group w-25">
                                {!! Form::label('subcategory_id', 'Sub Category:') !!}
                                {!! Form::select('subcategory_id', ['' => 'Choose'] + $subcategories, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group w-25 m-0">
                                {!! Form::label('price', 'Price:') !!}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-euro-sign"></i></div>
                                    </div>
                                    <input type="number" name="price" class="form-control" step="0.01" value="" required>
                                </div>
                            </div>
                        </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group w-50">
                                    {!! Form::label('photo_id', 'Edit Product Photo:') !!}
                                    {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image_edit', 'onchange' => 'putImageEdit()']) !!}
                                </div>
                                <div class="d-flex justify-content-center p-3">
                                    <img id="targetEdit" height="150" width="150" class="img-thumbnail"
                                         src="http://place-hold.it/150x150?text=No Image"
                                         alt="Profile Picture">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Product Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('subtitle', 'SubTitle:') !!}
                                {!! Form::text('subtitle', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
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
    <!-- End Modal Edit User-->
    <!-- End Modal Product-->

@endsection
@section('edit-delete-script')
<script>
    $('#editProduct').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let product_id = button.data('product_id') // Extract info from data-* attributes
        let category_id = button.data('category_id') // Extract info from data-* attributes
        let subcategory_id = button.data('subcategory_id') // Extract info from data-* attributes
        let photo_id = button.data('photo_id') // Extract info from data-* attributes
        let name = button.data('name') // Extract info from data-* attributes
        let title = button.data('title') // Extract info from data-* attributes
        let subtitle = button.data('subtitle') // Extract info from data-* attributes
        let description = button.data('description') // Extract info from data-* attributes
        let price = button.data('price') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this)
        modal.find('.modal-body #product_id').val(product_id)
        modal.find('.modal-body #category_id').val(category_id)
        modal.find('.modal-body #subcategory_id').val(subcategory_id)
        modal.find('.modal-body #photo_id').val(photo_id)
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #title').val(title)
        modal.find('.modal-body #subtitle').val(subtitle)
        modal.find('.modal-body #description').val(description)
        modal.find('.modal-body #price').val(price)

    })
</script>
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
