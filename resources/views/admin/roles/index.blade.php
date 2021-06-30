@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">Roles</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row justify-content-around mt-4">
        <div class="col-12 col-lg-7 mb-4">
            <div class="card card-dark shadow-lg border">
                <div class="card-header">
                    <h3 class="card-title mt-2">Roles:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createRole">
                            <i class="fas fa-plus mr-3"></i>Create
                        </button>
                        <div class="d-flex justify-content-center">
                            @if(Session::has('deleted_role'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('deleted_role')}}
                                </div>
                            @elseif(Session::has('created_role'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('created_role')}}
                                </div>
                            @elseif(Session::has('updated_role'))
                                <div class="alert alert-success fade show text-center" role="alert">
                                    {{session('updated_role')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                        <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Roles</th>
                            {{-- <th>Created</th>
                             <th>Updated</th>--}}
                            {{-- <th>Edit</th>
                             <th>Delete</th>--}}
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $roles )
                            @foreach( $roles as $role )
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    {{--<td>{{$role->created_at}}</td>
                                    <td>{{$role->updated_at}}</td>--}}
                                    <td class="d-flex align-items-center justify-content-around">
                                        <div>
                                            <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-name="{{ $role->name }}"
                                                    data-category_id="{{ $role->id }}" data-toggle="modal" data-target="#editRole">Edit
                                            </button>
                                        </div>
                                        <div>
                                            <button class="btn btn-xs btn-danger p-1 px-2 shadow" data-role_id="{{ $role->id }}" data-toggle="modal"
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
            <!-- Modal Create Role-->
            <div class="modal fade" id="createRole" tabindex="-1" role="dialog" aria-labelledby="createRoleCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-navy">
                            <h5 class="modal-title" id="createRoleLongTitle">Create Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::open(['method' => 'POST', 'action' => 'AdminRolesController@store']) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('Role Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
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
            <!-- End Modal Role-->
            <!-- Modal Edit Role-->
            <div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="editRoleCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-navy">
                            <h5 class="modal-title" id="editRoleLongTitle">Edit Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('roles.update', 'update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <input type="hidden" name="role_id" value="">
                                <div class="form-group">
                                    {!! Form::label('name', 'Role Name:') !!}
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
            <!-- End Modal Edit Role-->
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
                        <form method="post" action="{{ route('roles.destroy', 'destroy') }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input type="hidden" name="role_id" id="role_id" value="">
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
@section('edit-delete-script')
    <script>
        $('#editRole').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let name = button.data('name') // Extract info from data-* attributes
            let subcategory_id = button.data('role_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #role_id').val(role_id)
        })

        $('#delete').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let subcategory_id = button.data('role_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #role_id').val(role_id)
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


