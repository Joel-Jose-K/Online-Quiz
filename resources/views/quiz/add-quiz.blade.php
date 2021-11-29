@extends('layouts.app')

@section('title', 'Quiz')

@section('content')
    <h1>Quiz</h1>
    <div class="separator-breadcrumb border-top"></div>

    {{-- addQuizModal --}}
   <div class="modal fade" id="addQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('quiz.add') }}" method="post">
                @csrf
                <div class="modal-body">
                    <ul id="addquiz_errList"></ul>
                    <div class="form-group mb-3">
                        <label for="">Quiz Type</label>
                        <select name="quiz_type_id" class="quiz_type_id form-control">
                            <option value="">-- Select Quiz Type --</option>
                            @foreach ($quiz_types as $quiz_type)
                                <option value="{{ $quiz_type->id }}">{{ $quiz_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Quiz Title</label>
                        <input name="title" type="text" class="quiz_title form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Quiz Description</label>
                        <textarea name="description" cols="5" rows="5" class="quiz_description form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Active from</label>
                        <div class="input-group" id="datetimepicker1">
                            <input name="active_from" type="text" class="active_from form-control">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Active to</label>
                        <div class="input-group" id="datetimepicker2">
                            <input name="active_to" type="text" class="active_to form-control">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" value="submit" class="add_quiz btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
   </div>
   {{-- addQuizModal --}}

    {{-- editQuizModal --}}
   <div class="modal fade" id="editQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" novalidate id="editQuizForm">
                @method('put')
                @csrf
                <div class="modal-body">
                    <ul id="updatequiz_errList"></ul>
                    <input type="hidden" id="edit_quiz_id">
                    <div class="form-group mb-3">
                        <label for="">Quiz Type</label>
                        <select name="quiz_type_id" id="edit_quiz_type" class="quiz_type_id form-control">
                            <option value="">-- Select Quiz Type --</option>
                            @foreach ($quiz_types as $quiz_type)
                                <option value="{{ $quiz_type->id }}">{{ $quiz_type->name }}</option>
                            @endforeach
                        </select>
                        <span id="quiz_type_id_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Quiz Title</label>
                        <input name="title" id="edit_quiz_title" type="text" class="quiz_title form-control">
                        <span id="title_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Quiz Description</label>
                        <textarea name="description" id="edit_quiz_description" cols="5" rows="5" class="quiz_description form-control"></textarea>
                        <span id="description_error"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Active from</label>
                        <div class="input-group" id="datetimepicker3">
                            <input name="active_from" id="edit_active_from" type="text" class="active_from form-control">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <span id="active_from_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label">Active to</label>
                        <div class="input-group" id="datetimepicker4">
                            <input name="active_to" id="edit_active_to" type="text" class="active_to form-control">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <span id="active_to_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" value="submit" class="update_quiz btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
   </div>
   {{-- editQuizModal --}}

   {{-- deleteStudentModal --}}
    <div class="modal fade" id="deleteQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_quiz_id">
                    <h5>Are you sure you want to delete this record?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_quiz_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- deleteStudentModal --}}

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Quiz Data
                            <a href="#" data-toggle="modal" data-target="#addQuizModal" class="btn btn-primary float-end">Add Quiz</a>
                            {{-- <a href="{{ route('mcq.view') }}" class="btn btn-primary">Create MCQ</a> --}}
                            {{-- <a href="{{ route('contest.view') }}" class="btn btn-primary">List View Details</a> --}}
                        </h4>
                    </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Quiz Type</th>
                                        <th>Quiz Title</th>
                                        <th>Quiz Description</th>
                                        <th>Active from</th>
                                        <th>Active to</th>
                                        <th>Actions</th>
                                        {{-- <th>Published?</th> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" ></script> --}}

    <script type="text/javascript">
        $(function () {
            $("#datetimepicker1").datetimepicker({
                format: 'Y-MM-DD H:m',
            });
            $("#datetimepicker2").datetimepicker({
                format: 'Y-MM-DD H:m',
            });
            $("#datetimepicker3").datetimepicker({
                format: 'Y-MM-DD H:m',
            });
            $("#datetimepicker4").datetimepicker({
                format: 'Y-MM-DD H:m',
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            let siteUrl = $('#site-url').val();
            let modal = $('#editQuizModal');
            let editForm=modal.find('form');

            fetchquizdata();

            function fetchquizdata()
            {
                $.ajax({
                    type: "GET",
                    url: "fetch-quiz-data",
                    dataType: "json",
                    success: function (response) {
                        
                        $('tbody').html("");
                        $.each(response.quizdata, function (key, item) { 
                             $('tbody').append(
                                 `
                                <tr>\
                                    <td>${item.id}</td>\
                                    <td>${item.quiztype.name}</td>\
                                    <td>${item.title}</td>\
                                    <td>${item.description}</td>\
                                    <td>${item.active_from}</td>\
                                    <td>${item.active_to}</td>\
                                    <td>\
                                        <button type="button" data-id="${item.id}" class="edit_quiz btn btn-success" ><i class="nav-icon i-Pen-2 font-weight-bold"></i></button>\
                                        <button type="button" value="${item.id}" class="delete_quiz btn btn-danger">Delete</button>\
                                        <a href="${siteUrl + '/view-contest/'+item.id}" class="btn btn-info">View in detail</a>\
                                    </td>\
                                </tr>`
                            );
                        });
                    }
                });
            }

            $(document).on('click', '.delete_quiz', function (e) {
                e.preventDefault();

                var quiz_id = $(this).val();
                // alert(quiz_id);

                $('#delete_quiz_id').val(quiz_id);
                $('#deleteQuizModal').modal('show');
                
            });

            $(document).on('click', '.delete_quiz_btn', function (e) {
                e.preventDefault();

                var quiz_id = $('#delete_quiz_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "delete-quiz/"+quiz_id,
                    success: function (response) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#deleteQuizModal').modal('hide');
                        fetchquizdata();
                    }
                });
            });

            $(document).on('click', '.add_quiz', function (e) {
                e.preventDefault();

                var data = {
                    'quiz_type_id' : $('.quiz_type_id').val(),
                    'title'        : $('.quiz_title').val(),
                    'description'  : $('.quiz_description').val(),
                    'active_from'  : $('.active_from').val(),
                    'active_to'    : $('.active_to').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "quiz-submit",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if(response.status == 400)
                        {
                            $('#addquiz_errList').html("");
                            $('#addquiz_errList').addClass("alert alert-warning");
                            $.each(response.errors, function (key, err_values) { 
                                $('#addquiz_errList').append('<li>'+err_values+'</li>');
                            });
                        }
                        else
                        {
                            $('#addquiz_errList').hide();
                            $('#success_message').addClass("alert alert-success");
                            $('#success_message').text(response.message);
                            $('#addQuizModal').modal('hide');
                            $('#addQuizModal').find('select, input, textarea').val("");
                            fetchquizdata();
                        }
                    }
                });
            });

            function clearModal(){
                $('#addQuizModal').find('select, input, textarea').val("");
                modal.find('form').attr('action','');
            }

            $(document).on('click', '.edit_quiz', function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                // let form = $('#editQuizForm');
                // var formData = new FormData($('#editQuizForm')[0]);
                // console.log(...formData);


                $.ajax({
                    type: "GET",
                    url: siteUrl+"/edit-quiz/"+id, 
                    data: {},
                    dataType: "json",
                    // headers:{"X-HTTP-Method-Override": "PUT"},
                    success: function (response) {
                        // console.log(response.data);
                        fillModal(response.data);
                    }
                });
                function fillModal(quiz){
                    

                modal.find('#edit_quiz_type').val(quiz.quiz_type_id);
                modal.find('#edit_quiz_title').val(quiz.title);
                modal.find('#edit_quiz_description').val(quiz.description);
                modal.find('#edit_active_from').val(quiz.active_from);
                modal.find('#edit_active_to').val(quiz.active_to);
                modal.find('form').attr('action',siteUrl+'/update-quiz/'+quiz.id);


                modal.modal('show');
                }
  
            });



            $(document).on('click', '.update_quiz', function (e) {
                e.preventDefault();

                editForm.submit();

               
            });

            editForm.validate({

normalizer: function(value) {
    return $.trim(value);
}
, ignore: []
, rules: {
    quiz_type_id: {

        required: true
    }

    , title: {

        required: true
        , maxlength: 250
    , }
    , description: {

        required: false
        , maxlength: 600


    , }
    , active_from: {

        required: true

    , }
    , active_to: {

        required: true

    , }


}
, messages: {
    quiz_type_id: {

        required: "Quiz type is required!"

    , }
    , title: {

        required: "Please add a title!"

    , }
    , active_from: {

        required: "Please add a start date!"

    , }
    , active_to: {

        required: "Please add an end date!"

    , } 
}
, errorPlacement: function(error, element) {
    console.log(error);
    var name = $(element).attr('name');

    $('#' + name + '_error').html(error);

}
, submitHandler: function(form, event) {
    event.preventDefault();
   
    var formData = new FormData($(form)[0]);

    $(form).find('.js-error').html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: $(form).attr('action')
        , data: formData
        , contentType: false
        , processData: false
        , dataType : "json"
        , type: "POST"
        ,headers:{"X-HTTP-Method-Override": "PUT"}
        , error: function(resp) {
           

        }
        , success: function(response) {

            if (response.status == 400) {
                
                $('#updatequiz_errList').html("");
                $('#updatequiz_errList').addClass("alert alert-warning");
                $.each(response.errors, function (key, err_values) { 
                    $('#updatequiz_errList').append('<li>'+err_values+'</li>');
                });

            } else {
                $('#editQuizModal').modal('hide');
                $('#editQuizForm').find('select, input, textarea').val("");
                $('#success_message').addClass("alert alert-success");
                $('#success_message').text(response.message);
                fetchquizdata();
            }
        }
    });
}
});
    });
    </script>
@endpush