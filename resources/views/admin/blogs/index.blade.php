@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Blogs</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Blogs:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createBlog">
                    <i class="fas fa-plus mr-3"></i>Create
                </button>
                <div class="d-flex justify-content-end">
                    @if(Session::has('deleted_blog'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('deleted_blog')}}
                        </div>
                    @elseif(Session::has('created_blog'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('created_blog')}}
                        </div>
                    @elseif(Session::has('updated_blog'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_blog')}}
                        </div>
                    @elseif(Session::has('softdeleted_blog'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('softdeleted_blog')}}
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Description</th>
                    {{-- <th class="sorting">Created</th>
                     <th class="sorting">Updated</th>--}}
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( $blogs )
                    @foreach( $blogs as $blog )
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->user->name }}</td>
                            <td>{{ $blog->blogcategory->name }}</td>
                            <td>
                                <img height="62" width="62" class="img-thumbnail shadow"
                                     src="{{ $blog->photo ? asset('images/' . $blog->photo->file) : 'http://place-hold.it/62x62?text=No Image' }}"
                                     alt="Blog Picture">
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->description }}</td>
                            {{-- <td>{{$blog->created_at}}</td>
                             <td>{{$blog->updated_at}}</td>--}}
                            <td class="d-flex align-items-center justify-content-around">
                                <div class="mr-2">
                                    <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-blog_id="{{ $blog->id }}"
                                            data-title="{{ $blog->title }}" data-description="{{ $blog->description }}" data-toggle="modal"
                                            data-blog_category_id="{{ $blog->blog_category_id }}" data-photo_id="{{ $blog->photo_id }}"
                                            data-user_id="{{ $blog->user->id }}" data-target="#editBlog">Edit</button>
                                </div>
                                <div>
                                <button class="btn btn-xs btn-danger p-1 px-2 shadow" data-blog_id="{{ $blog->id }}"
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

    <!-- Modal Create Blog-->
    <div class="modal fade" id="createBlog" tabindex="-1" role="dialog" aria-labelledby="createBlogCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="createBlogLongTitle">Create Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' => 'POST', 'action' => 'AdminBlogsController@store', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-around">
                        <div class="form-group">
                            {!! Form::label('Blog Category:') !!}
                            {!! Form::select('blog_category_id', ['' => 'Choose'] + $blogCategories, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Blog Photo:') !!}
                            {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()']) !!}
                        </div>
                        <img id="target" class="img-thumbnail shadow" height="200" width="200"
                             src="http://place-hold.it/200x200?text=Select Blog Image" alt="Blog Picture">
                    </div>
                    <div class="form-group">
                        {!! Form::label('Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
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
    <!-- End Modal Create Blog-->

    <!-- Modal Edit Blog-->
    <div class="modal fade" id="editBlog" tabindex="-1" role="dialog" aria-labelledby="editBlogCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h5 class="modal-title" id="editBlogLongTitle">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('blogs.update', 'update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="blog_id" id="blog_id" value="">
                        <div class="form-group">
                            <div class="form-group w-50">
                                {!! Form::label('blog_category_id', 'BlogCategory:') !!}
                                {!! Form::select('blog_category_id', ['' => 'Choose'] + $blogCategories, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group">
                            {!! Form::label('photo_id', 'Blog Photo:') !!}
                            {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image_edit', 'onchange' => 'putImageEdit()']) !!}
                        </div>
                        <img id="targetEdit" class="img-thumbnail shadow" height="200" width="200"
                             src="http://place-hold.it/200x200?text=Select Blog Image" alt="Blog Picture">
                        </div>
                        <div class="form-group">
                            {!! Form::label('title', 'Title:') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
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
    <!-- End Modal Edit Blog-->


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
                <form method="post" action="{{ route('blogs.destroy', 'destroy') }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="blog_id" id="blog_id" value="">
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
        $('#editBlog').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let blog_id = button.data('blog_id') // Extract info from data-* attributes
            let user_id = button.data('user_id') // Extract info from data-* attributes
            let photo_id = button.data('photo_id') // Extract info from data-* attributes
            let blog_category_id = button.data('blog_category_id') // Extract info from data-* attributes
            let title = button.data('title') // Extract info from data-* attributes
            let description = button.data('description') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #blog_id').val(blog_id)
            modal.find('.modal-body #user_id').val(user_id)
            modal.find('.modal-body #photo_id').val(photo_id)
            modal.find('.modal-body #blog_category_id').val(blog_category_id)
            modal.find('.modal-body #title').val(title)
            modal.find('.modal-body #description').val(description)
        })

        $('#delete').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let blog_id = button.data('blog_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #blog_id').val(blog_id)
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
