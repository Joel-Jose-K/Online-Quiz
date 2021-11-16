@extends('layouts.app')

@section('title', 'Quiz Type')

@section('content')
    <h1>Quiz Type</h1>
    <div class="separator-breadcrumb border-top"></div>

    {{-- addQuizTypeModal --}}
    <div class="modal fade" id="addQuizTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Quiz Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <ul id="addquiztype_errList"></ul>
                    <div class="form-group mb-3">
                        <label for="">Quiz Name</label>
                        <input type="text" class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Unique Name</label>
                        <input type="text" class="unique_name form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_quiz_type">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- addQuizTypeModal --}}

    {{-- editQuizTypeModal --}}
    <div class="modal fade" id="editQuizTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit & Update Quiz Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <ul id="updatequiztype_errList"></ul>
                    <input type="hidden" id="edit_quiz_type_id">
                    <div class="form-group mb-3">
                        <label for="">Quiz Name</label>
                        <input type="text" id="edit_name" class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Unique Name</label>
                        <input type="text" id="edit_unique_name"  class="unique_name form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_quiz_type">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- editQuizTypeModal --}}

    {{-- deleteQuizTypeModal --}}
    <div class="modal fade" id="deleteQuizTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Quiz Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_quiz_type_id">
                    <h4>Are you sure you want to delete this record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_quiz_type_btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- deleteQuizTypeModal --}}

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Quiz Type Data
                        <a href="#" data-toggle="modal" data-target="#addQuizTypeModal" class="btn btn-primary float-end">Add Quiz Type</a>
                    </h4>
                </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Quiz Name</th>
                                    <th>Unique Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            fetchquiztypes();

            function fetchquiztypes()
            {
                $.ajax({
                    type: "GET",
                    url: "fetch-quiz-types",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response.quiztypes);
                        $('tbody').html("");
                        $.each(response.quiztypes, function (key, item) { 
                             $('tbody').append(
                                '<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.unique_name+'</td>\
                                    <td>\
                                        <button type="button" value="'+item.id+'" class="edit_quiz_type btn btn-success"><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>\
                                        <button type="button" value="'+item.id+'" class="delete_quiz_type btn btn-danger">Delete</button>\
                                    </td>\
                                </tr>'
                             );
                        });
                    }
                });
            }

            $(document).on('click', '.delete_quiz_type', function (e) {
                   e.preventDefault();
                   var quiz_type_id = $(this).val();
                   
                   $('#delete_quiz_type_id').val(quiz_type_id);
                   $('#deleteQuizTypeModal').modal('show');
            });

            $(document).on('click', '.delete_quiz_type_btn', function (e) {
                e.preventDefault();

                var quiz_type_id = $('#delete_quiz_type_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "delete-quiz-type/"+quiz_type_id,
                    success: function (response) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#deleteQuizTypeModal').modal('hide');
                        fetchquiztypes();
                    }
                });
            });

            $(document).on('click', '.edit_quiz_type', function (e) {
                e.preventDefault();
                var quiz_type_id = $(this).val();
                
                $('#editQuizTypeModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "edit-quiz-type/"+quiz_type_id,
                    success: function (response) {
                        if(response.status == 404)
                        {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }
                        else
                        {
                            $('#edit_name').val(response.quiz_type.name),
                            $('#edit_unique_name').val(response.quiz_type.unique_name),
                            $('#edit_quiz_type_id').val(quiz_type_id)
                        }
                    }
                });
            });

            $(document).on('click', '.update_quiz_type', function (e) {
                e.preventDefault();
                var quiz_type_id = $('#edit_quiz_type_id').val();

                var data = {
                    'name' : $('#edit_name').val(),
                    'unique_name' : $('#edit_unique_name').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-quiz-type/"+quiz_type_id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 400) {
                            $('#updatequiztype_errList').html("");
                            $('#updatequiztype_errList').addClass("alert alert-warning");
                            $.each(response.errors, function (key, err_values) { 
                                 $('#updatequiztype_errList').append('<li>'+err_values+'</li>');
                            });
                        }else if(response.status == 404){
                            $('#updatequiztype_errList').html("");
                            $('#success_message').addClass("alert alert-success");
                            $('#success_message').text(response.message);
                        } else {
                            $('#updatequiztype_errList').hide();
                            $('#success_message').html("");
                            $('#success_message').addClass("alert alert-success");
                            $('#success_message').text(response.message);
                            $('#editQuizTypeModal').modal('hide');
                            fetchquiztypes();
                        }
                    }
                });
            });

            $(document).on('click', '.add_quiz_type', function (e) {
            e.preventDefault();

            var data = {
                'name'       : $('.name').val(),
                'unique_name': $('.unique_name').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                type: "POST",
                url: "quiz-type-submit",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#addquiztype_errList').html("");
                        $('#addquiztype_errList').addClass("alert alert-warning");
                        $.each(response.errors, function (key, err_values) { 
                            $('#addquiztype_errList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else
                    {
                        $('#addquiztype_errList').hide();
                        $('#success_message').addClass("alert alert-success");
                        $('#success_message').text(response.message);
                        $('#addQuizTypeModal').modal('hide');
                        $('#addQuizTypeModal').find('input').val("");
                        fetchquiztypes();
                    }
                }
            });
            });
        });
    </script>
@endpush