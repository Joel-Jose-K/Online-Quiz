@extends('layouts.app')

@section('title', 'MCQ')

@section('content')
    <h1>MCQ Details</h1>
    <div class="pull-right">
        <a href="{{ route('quiz.view') }}" class="btn btn-info pull-right">Back</a>

        {{-- <a href="{{ route('mcq.view') }}" class="btn btn-primary">Create new MCQ</a> --}}
    </div>

    <div class="separator-breadcrumb border-top"></div>

    
        <div class="row">
            <div class="col-md-6">Quiz Type</div>
            <div class="col-md-6">{{ $quiz->quiz_type_id }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Quiz Title</div>
            <div class="col-md-6">{{ $quiz->title }}</div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Quiz Description</div>
            <div class="col-md-6">{{ $quiz->description }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Active from</div>
            <div class="col-md-6">{{ $quiz->active_from }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Active to</div>
            <div class="col-md-6">{{ $quiz->active_to }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Status</div>
            <div class="col-md-6">{{ $quiz->status }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Published</div>
            <div class="col-md-6">{{ $quiz->is_publish }}</div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">Evaluated</div>
            <div class="col-md-6">{{ $quiz->is_evaluate }}</div>
        </div>
        <br>
        <br>

    {{-- add question and selected answers --}}
    <div class="separator-breadcrumb border-top"></div>
    <form action="{{ route('update.answer') }}" method="POST" id="update-option-form">
        @csrf
        <div id="update_success_message"></div>
        <div>
            @php
                $i = 1;
                $quesionIndex = 1;
            @endphp
    
            @foreach ($quiz->quizQuestions as $question)
    
                @php
                    $q                = $question->question;
                    $answerOptionId   = $question->question_answer_option_id;
                    $newQuestionIndex = $quesionIndex++;
                @endphp
                <input type="hidden" name="question[{{ $newQuestionIndex }}][question_id]" value="{{ $q->id }}">
                
    
                <div><h4>{{ $i++ }}) {{ $q->question }}</h4></div>
                    
                
                <div class="row">
                    @foreach ($q->questionansweroption as $option)
                    
                    
                    <input name="question[{{ $newQuestionIndex }}][answer_option_id]" type="radio" {{ $answerOptionId == $option->id ? 'checked':'' }} value="{{ $option->id }}">
                    <div class="col-md-2 col-xs-4">{{ $option->answer_option }}</div>
    
                    @endforeach
                </div>
                <hr>
                
    
            @endforeach
            <button type="submit" class="btn btn-success" id="update_result">Update the result</button>
        </div> 
    </form>
    
@endsection

@push('scripts')
    <script src="{{ asset('assets/cdn/jquery.validate.min.js') }}" ></script>
    <script src="{{ asset('assets/cdn/additional-methods.min.js') }}" ></script>

    <script>
        $(document).ready(function () {
            
            let updateForm = $('#update-option-form');


            $(document).on('click', '#update_result', function (e) {
                e.preventDefault();

                updateForm.submit();

            });

            updateForm.validate({

                normalizer: function(value) {
                    return $.trim(value);
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
                        , headers:{"X-HTTP-Method-Override": "PUT"}
                        , success: function (response) {

                            if(response.status == 400) {
                                $('#update_success_message').html("");
                                $('#update_success_message').addClass("alert alert-danger");
                                $.each(response.errors, function (key, err_values) { 
                                     $('#update_success_message').append('<li>'+err_values+'</li>');
                                });
                            } else {
                                $('#update_success_message').addClass("alert alert-success");
                                $('#update_success_message').text(response.message);
                            }
                        }
                    });
                }
            });

        });
    </script>
@endpush