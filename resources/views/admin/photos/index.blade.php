@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
@endsection
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Photos</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Photos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around mt-4">
        {{-- <div class="col-4 mb-4">
             <div class="card card-dark shadow">
                 <div class="card-header rounded-0">
                     <h3 class="card-title mt-2">Upload Photo:</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                         --}}{{--<a href="{{route('categories.create')}}" class="btn border-light">Create Category</a>--}}{{--
                         --}}{{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}{{--
                     </div>
                 </div>
                 <div class="card-body">
                     {!! Form::open(['method' => 'POST', 'action' => 'AdminPhotosController@store', 'class' => 'dropzone']) !!}
                     {!! Form::close() !!}
                 </div>
             </div>
         </div>--}}
        <div class="col-12 col-lg-7 mb-4">
            <div class="card card-dark shadow-lg border">
                <div class="card-header">
                    <h3 class="card-title mt-2">Photos:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createPhoto">
                            <i class="fas fa-plus mr-3"></i>Upload
                        </button>
                        <div class="d-flex justify-content-center">
                            @if(Session::has('deleted_photo'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('deleted_photo')}}
                                </div>
                            @elseif(Session::has('created_photo'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('created_photo')}}
                                </div>
                            @elseif(Session::has('updated_photo'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('updated_photo')}}
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
                            {{--<th>Filename</th>--}}
                            {{-- <th>Created</th>
                             <th>Updated</th>--}}
                            {{-- <th>Edit</th>
                             <th>Delete</th>--}}
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $photos )
                            @foreach( $photos as $photo )
                                <tr>
                                    <td>{{ $photo->id }}</td>
                                    <td>
                                        <img height="60" width="60" class="img-thumbnail shadow"
                                             src="{{ $photo ? asset('images/' . $photo->file) : 'http://place-hold.it/60x60?text=No Image' }}"
                                             alt="Photo">
                                    </td>
                                    <td>{{ $photo->name }}</td>
                                    {{-- <td>{{$photo->file}}</td>--}}
                                    {{--  <td>{{$photo->created_at}}</td>
                                      <td>{{$photo->updated_at}}</td>--}}
                                    <td class="d-flex align-items-center justify-content-around">
                                        <div>
                                            <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-name="{{ $photo->name }}"
                                                    data-photo_id="{{ $photo->id }}" data-toggle="modal" data-target="#editPhoto">Edit
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-xs btn-danger p-1 px-2 shadow" data-photo_id="{{ $photo->id }}" data-toggle="modal"
                                                    data-target="#delete">Delete
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
            <!-- Modal Create Photo-->
            <div class="modal fade" id="createPhoto" tabindex="-1" role="dialog" aria-labelledby="createPhotoCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-navy">
                            <h5 class="modal-title" id="createPhotoLongTitle">Upload Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::open(['method' => 'POST', 'action' => 'AdminPhotosController@store', 'files' => true]) !!}
                        <div class="modal-body">
                            {{--{!! Form::open(['method' => 'POST', 'action' => 'AdminPhotosController@store', 'class' => 'dropzone']) !!}
                            {!! Form::close() !!}--}}
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group">
                                    <label for="file">Get Photo:</label>
                                    <input type="file" name="file" class="form-control-file" id="select_image" onchange="putImage()">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img id="target" class="img-thumbnail shadow" height="150" width="150"
                                         src="http://place-hold.it/150x150?text=Select Image" alt="Picture">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-info shadow">Upload</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- End Modal Create Photo-->
            <!-- Modal Edit Photo-->
            <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-navy">
                            <h5 class="modal-title" id="editPhotoLongTitle">Edit Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('photos.update', 'update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <input type="hidden" name="photo_id" value="">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name:') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
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
            <!-- End Modal Edit Photo-->
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
                        <form method="post" action="{{ route('photos.destroy', 'destroy') }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input type="hidden" name="photo_id" id="photo_id" value="">
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

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
@endsection
@section('edit-delete-script')
    <script>
        $('#editPhoto').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let name = button.data('name') // Extract info from data-* attributes
            let photo_id = button.data('photo_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #photo_id').val(photo_id)
        })

        $('#delete').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let photo_id = button.data('photo_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #photo_id').val(photo_id)
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
