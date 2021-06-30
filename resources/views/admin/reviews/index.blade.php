@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Reviews</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Reviews:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <div>
                        @if(Session::has('deleted_review'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('deleted_review')}}
                            </div>
                        @elseif(Session::has('created_review'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('created_review')}}
                            </div>
                        @elseif(Session::has('updated_review'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('updated_review')}}
                            </div>
                        @elseif(Session::has('softdeleted_review'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('softdeleted_review')}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Rating</th>
                    {{-- <th class="sorting">Created</th>
                     <th class="sorting">Updated</th>--}}
                    {{--<th>Edit</th>--}}
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( $reviews )
                    @foreach( $reviews as $review )
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->user->email }}</td>
                            <td>
                                <img height="60" width="60"
                                     src="{{ $review->product->photo ? asset('images/' . $review->product->photo->file) : 'http://place-hold.it/60x60?text=.' }}"
                                     alt="User Picture">
                            </td>
                            <td>{{ $review->description }}</td>
                            <td>{{ $review->rating }}</td>
                            {{--  <td>{{$review->created_at}}</td>
                              <td>{{$review->updated_at}}</td>--}}
                            <td class="d-flex align-items-center justify-content-around">
                                <div>
                                    <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow"
                                            data-review_id="{{ $review->id }}" data-description="{{ $review->description }}"
                                            data-rating="{{ $review->rating }}" data-toggle="modal" data-target="#editReview">Edit
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-xs btn-danger p-1 px-2 shadow" data-review_id="{{ $review->id }}"
                                            data-toggle="modal" data-target="#delete">Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Start Modals -->
    @if(count($reviews) > 0) {{--Anders word pagina niet geladen want zoek om afbeelding --}}
    <!-- Modal Edit Review-->
    <div class="modal fade" id="editReview" tabindex="-1" role="dialog" aria-labelledby="editReviewCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="editReviewLongTitle">Edit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('reviews.update', 'update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="review_id" id="review_id" value="">
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                {!! Form::label('Rating:') !!}
                                {!! Form::number('rating', null, ['class' => 'form-control rounded-0', 'required', 'id' => 'rating']) !!}
                            </div>
                            <div>
                                <img height="200" width="200" class="img-thumbnail shadow"
                                     src="{{ $review->product->photo ? asset('images/' . $review->product->photo->file) : 'http://place-hold.it/200x200?text=.' }}"
                                     alt="Product Picture">
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Description:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control rounded-0', 'required', 'rows' => 3, 'id' => 'description']) !!}
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
    <!-- End Modal Edit Review-->
    @endif
    <!-- Modal Delete-->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h5 class="modal-title text-center" id="deleteLongTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('reviews.destroy', 'destroy') }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="review_id" id="review_id" value="">
                        <p class="text-center">Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger shadow">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Delete-->
    <!-- End Modals -->
@endsection
@section('edit-delete-script')
    <script>
        $('#editReview').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let review_id = button.data('review_id') // Extract info from data-* attributes
            let description = button.data('description') // Extract info from data-* attributes
            let rating = button.data('rating') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #review_id').val(review_id)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #rating').val(rating)
        })

        $('#delete').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let review_id = button.data('review_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #review_id').val(review_id)
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



