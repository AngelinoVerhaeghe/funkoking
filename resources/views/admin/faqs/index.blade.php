@extends('layouts.admin')
@section('content-header')
    <div class="content-header pb-0">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h1 class="m-0 text-dark">FAQ</h1>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-12 col-lg-10 offset-1">
            <div class="card card-dark shadow-lg border">
                <div class="card-header">
                    <h3 class="card-title mt-2">FAQ's:</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    <!-- Button trigger modal Create FAQ-->
                    <button type="button" class="btn btn-info mb-3 shadow" data-toggle="modal" data-target="#createFaq">
                        <i class="fas fa-plus mr-3"></i>Create
                    </button>
                    <div class="d-flex justify-content-center">
                        @if(Session::has('deleted_faq'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('deleted_faq')}}
                            </div>
                        @elseif(Session::has('created_faq'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('created_faq')}}
                            </div>
                        @elseif(Session::has('updated_faq'))
                            <div class="alert alert-success fade show text-center" role="alert">
                                {{session('updated_faq')}}
                            </div>
                        @endif
                    </div>
                    </div>
                    <table class="table table-bordered table-hover dataTable text-center example2 p-1">
                        <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Question</th>
                            <th>Answer</th>
                            {{-- <th>Created</th>
                             <th>Updated</th>--}}
                            {{--<th>Edit</th>
                            <th>Delete</th>--}}
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $faqs )
                            @foreach( $faqs as $faq )
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td>{{ $faq->faqcategory->name }}</td>
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ $faq->answer }}</td>
                                    {{-- <td>{{$faq->created_at}}</td>
                                     <td>{{$faq->updated_at}}</td>--}}
                                    <td class="d-flex align-items-center justify-content-around">
                                      <div class="mr-2">
                                        <button class="btn btn-xs bg-primary text-white p-1 px-2 shadow" data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}"
                                                data-faq_category_id="{{ $faq->faqcategory->id }}" data-faq_id="{{ $faq->id }}" data-toggle="modal" data-target="#editFaq">Edit</button>
                                       </div>
                                        <div>
                                            <button class="btn btn-xs btn-danger p-1 px-2 shadow" data-faq_id="{{ $faq->id }}"
                                                    data-toggle="modal" data-target="#delete">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Start Modals -->
        <!-- Modal Create Faq-->
        <div class="modal fade" id="createFaq" tabindex="-1" role="dialog" aria-labelledby="createFaqCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title" id="createFaqLongTitle">Create Faq</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminFaqsController@store']) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('Faq Category:') !!}
                            {!! Form::select('faq_category_id', ['' => 'Choose'] + $faqcategories, null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group mt-3">
                            {!! Form::label('Question:') !!}
                            {!! Form::text('question', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group mt-3">
                            {!! Form::label('Answer:') !!}
                            {!! Form::textarea('answer', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
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
        <!-- End Modal Create Faq-->
        <!-- Modal Edit Faq-->
        <div class="modal fade" id="editFaq" tabindex="-1" role="dialog" aria-labelledby="editFaqCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-navy">
                        <h5 class="modal-title" id="editFaqLongTitle">Edit FAQ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('faqs.update', 'update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <input type="hidden" name="faq_id" value="">
                            <div class="form-group">
                                {!! Form::label('faq_category_id', 'Category:') !!}
                                {!! Form::select('faq_category_id', ['' => 'Choose'] + $faqcategories, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group mt-3">
                                {!! Form::label('question', 'FAQ Question:') !!}
                                {!! Form::text('question', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group mt-3">
                                {!! Form::label('answer', 'Answer:') !!}
                                {!! Form::textarea('answer', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
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
        <!-- End Modal Edit Faq-->
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
                    <form method="post" action="{{ route('faqs.destroy', 'destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <input type="hidden" name="faq_id" id="faq_id" value="">
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
@endsection
@section('edit-delete-script')
    <script>
        $('#editFaq').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let faq_id = button.data('faq_id') // Extract info from data-* attributes
            let faq_category_id = button.data('faq_category_id') // Extract info from data-* attributes
            let question = button.data('question') // Extract info from data-* attributes
            let answer = button.data('answer') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #faq_id').val(faq_id)
            modal.find('.modal-body #faq_category_id').val(faq_category_id)
            modal.find('.modal-body #question').val(question)
            modal.find('.modal-body #answer').val(answer)
        })

       /* $('#delete').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let category_id = button.data('category_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('.modal-body #category_id').val(category_id)
        })*/
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
