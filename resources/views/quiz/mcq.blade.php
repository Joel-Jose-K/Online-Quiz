@extends('layouts.app')

@section('title', 'MCQ')

@section('content')
    <h1>Add MCQ</h1>
    <div class="separator-breadcrumb border-top"></div>

    <div class="card body">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif

        @if(Session::has('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

            <form action="{{ route('mcq.submit') }}" method="POST" id="createMcq" class="add_another_question">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="question">Question</label>
                        <textarea name="question[1][question]" class="form-control validate_check" cols="10" rows="10"></textarea>
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="Type">Type</label>
                        <select name="question[1][type]" id="Type" class="form-control validate_check">
                            <option value="">-- Select Quiz Type --</option>
                            @foreach ($quizs as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="Options">Options</label>
                        <div class="options-container">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control validate_check" name="question[1][option][1][option_text]">
                                </div>
                                <div class="col-xs-1 add_option_btn" data-question-index="1">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </div>
                                <div class="col-xs-2">
                                    <input name="question[1][option][1][is_answer]" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="form-group col-md-6 offset-md-3">
                <button id="add_another_question" class="btn btn-info">Add another question</button>
            </div>
            <div class="form-group col-md-6 offset-md-3">
                <button type="submit" value="submit" class="btn btn-primary" id="add" form="createMcq">Submit</button>
            </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/cdn/jquery.validate.min.js') }}" ></script>
    <script src="{{ asset('assets/cdn/additional-methods.min.js') }}" ></script>
    
        <script type="text/javascript">
        $(document).ready(function () {

            let addForm = $("form");
            let QuestionIndex = 1;
            let optionIndex = 1;
            // newly added
            let answerIndex = 1;

            $(document).on('click', '#add', function (e) {
                e.preventDefault();

                addForm.submit();

            });
           
            addForm.validate({
                submitHandler: function(form, event){
                    event.preventDefault();
                    
                    var formData = new FormData(addForm[0]);


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "method",
                        url: addForm.attr('action')
                        , data: formData
                        , contentType: false
                        , processData: false
                        , dataType: "json"
                        , type: "POST"
                        , error: function(response){

                        }
                        ,success: function (response) {
                            if(response.status == 400){

                            } else {

                            }
                        }
                    });
                }
            });


            $.validator.addClassRules("validate_check", {
                required: true,
            });


            let container = $('.options-container');
            
            $(document).on('click', '.add_option_btn', function () {
            
                let newOptionIndex = ++optionIndex;
                let questionindex = $(this).data('question-index');
                let answerindex = ++answerIndex;

                let html=`

                    <div class="row">
                    <div class="col-xs-8">
                        <input type="text" class="form-control validate_check" name="question[${questionindex}][option][${newOptionIndex}][option_text]">
                    </div>
                    <div class="col-xs-1 ">
                        <span class="glyphicon glyphicon-trash delete-option">delete</span>
                    </div>
                    <div class="col-xs-2">
                        <input name="question[${questionindex}][option][${newOptionIndex}][is_answer]" type="checkbox">
                    </div>
                    </div>
                    
                `;

                $(this).closest('.options-container').append(html);

            });

            $(document).on('click', '.delete-option', function () {
                $(this).closest('.row').remove();
            });

            let add_another_question = $('.add_another_question');
           

            $(document).on('click', '#add_another_question', function () {

                let newIndex = ++QuestionIndex;
                let newOptionIndex = ++optionIndex;
                let questionindex = $(this).data('question-index');
                // let answerIndex = ++;

                let html=`

                <div class="add_another_question">
               
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="Question">Question</label>
                        <textarea name="question[${newIndex}][question]" class="form-control validate_check" cols="10" rows="10"></textarea>
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="Type">Type</label>
                        <select name="question[${newIndex}][type]" id="Type" class="form-control validate_check">
                            <option value="">-- Select Quiz --</option>
                            @foreach ($quizs as $quiz)
                                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="Options">Options</label>
                        <div class="options-container">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control validate_check" name="question[${newIndex}][option][${newOptionIndex}][option_text]">
                                </div>
                                <div class="col-xs-1 add_option_btn" id="" data-question-index="${newIndex}">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </div>
                                <div class="col-xs-2">
                                    <input name="question[${questionindex}][option][${newOptionIndex}][is_answer]" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <div class="col-xs-1 ">
                    <button class="delete-another-question btn btn-danger">Remove this question</button>
                </div>
                </div>
                    
                `;

                add_another_question.append(html);

                $(document).on('click', '.delete-another-question', function () {
                    $(this).closest('.add_another_question').remove();
                });
            });

            // $(document).on('click', '#add', function (e) {
            //     e.preventDefault();
            // });            

        });

    </script>
@endpush