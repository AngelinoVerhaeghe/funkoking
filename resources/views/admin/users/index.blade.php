@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="card card-dark shadow-lg border">
        <div class="card-header">
            <h3 class="card-title mt-2">Users:</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createUser">
                    <i class="fas fa-user-plus mr-3"></i>Create
                </button>
                <div class="d-flex justify-content-end">
                    @if(Session::has('deleted_user'))
                        <div class="alert alert-success fade show text-center shadow" role="alert">
                            {{session('deleted_user')}}
                        </div>
                    @elseif(Session::has('created_user'))
                        <div class="alert alert-success fade show text-center shadow" role="alert">
                            {{session('created_user')}}
                        </div>
                    @elseif(Session::has('updated_user'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('updated_user')}}
                        </div>
                    @elseif(Session::has('softdeleted_user'))
                        <div class="alert alert-success fade show text-center" role="alert">
                            {{session('softdeleted_user')}}
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
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( $users )
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <img height="50" width="50" class="img-thumbnail shadow"
                                     src="{{ $user->photo ? asset('images/' . $user->photo->file) : 'http://place-hold.it/40x40?text=.'}}"
                                     alt="User Picture">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    @if($role->name == 'Administrator')
                                        <span class="badge badge-info shadow">{{ $role->name }}</span>
                                    @elseif($role->name == 'Buyer')
                                        <span class="badge badge-warning shadow">{{ $role->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td class="d-flex align-items-center justify-content-around">
                                <div>
                                    <a class="btn btn-xs bg-secondary text-white p-1 px-2 shadow" href="{{route('profile', $user->id)}}">Profile</a>
                                </div>
                                <div>
                                    <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-user_id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                             data-role_id="{{ $user->roles }}" data-photo_id="{{ $user->photo_id }}" data-toggle="modal" data-target="#editUser">Edit
                                    </button>
                                </div>
                                @if($user->deleted_at != NULL)
                                    <a class="btn btn-xs bg-danger text-white p-1 px-2 shadow" href="{{route('admin.userrestore', $user->id)}}">Not
                                        Active</a>
                                @else
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
                                    <div>
                                        {!! Form::button('Active', ['type' => 'submit', 'class' => 'btn btn-success btn-xs p-1 px-2 shadow']) !!}
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

        <!-- Modal Create User-->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title" id="createUserLongTitle">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
                    <div class="modal-body">
                        <div class="d-flex justify-content-around">
                            <div class="form-group">
                                {!! Form::label('Select Role:') !!}
                                {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => 'multiple', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Select Photo:') !!}
                                {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image', 'onchange' => 'putImage()']) !!}
                            </div>
                            <div>
                                <img id="target" class="img-thumbnail" height="150" width="150"
                                     src="http://place-hold.it/150x150?text=Select User Photo"
                                     alt="User Picture">
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Email:') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Password:') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-info shadow">Create</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- End Modal User-->
        </div>

        <!-- Modal Edit User-->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title" id="editUserLongTitle">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('users.update', 'update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group w-25 mr-4">
                                    {!! Form::label('roles[]', 'Select Role(s):') !!}
                                    {!! Form::select('roles[]', $roles, $user->roles->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                                </div>
                                {{--<div class="d-flex justify-content-center p-3">
                                    <img height="150" width="150" class="img-thumbnail" src="{{ asset('images/' . $user->photo->file) }}"
                                         alt="Product Picture">
                                </div>--}}
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-group w-50">
                                    {!! Form::label('photo_id', 'Edit Profile Photo:') !!}
                                    {!! Form::file('photo_id', ['class' => 'form-control-file', 'id' => 'select_image_edit', 'onchange' => 'putImageEdit()']) !!}
                                </div>
                                <div class="d-flex justify-content-center p-3">
                                    <img id="targetEdit" height="150" width="150" class="img-thumbnail" src="http://place-hold.it/150x150?text=No Image"
                                         alt="Profile Picture">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
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
    </div>

@endsection
@section('edit-delete-script')
    <script>
        $('#editUser').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let user_id = button.data('user_id') // Extract info from data-* attributes
            let name = button.data('name') // Extract info from data-* attributes
            let email = button.data('email') // Extract info from data-* attributes
            let photo_id = button.data('photo_id') // Extract info from data-* attributes
            let role_id = button.data('role_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #user_id').val(user_id)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #photo_id').val(photo_id)
            modal.find('.modal-body #role_id').val(role_id)

        })
    </script>
@endsection
@section('image-script')
    <!--Script foto weergave bij veranderen foto-->
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
