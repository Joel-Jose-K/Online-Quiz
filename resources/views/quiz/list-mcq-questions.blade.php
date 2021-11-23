@extends('layouts.app')

@section('title', 'MCQ')

@section('content')
    <h1>MCQ Details</h1>
    <div class="pull-right">
        <a href="{{ route('quiz.view') }}" class="btn btn-info pull-right">Back</a>
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

    <div class="row">
        @foreach ($quiz->quizQuestions as $question)
            @php
                $q = $question->question;
            @endphp
    
            <div class="col-md-12">{{ $q->question }}</div>
            @foreach ($q->questionansweroption as $option)
                <div class="col-md-6">{{ $option->answer_option }}</div>
            @endforeach
        @endforeach
        {{-- <div class="col-md-12">test</div>
        <div class="col-md-6"></div> --}}
    </div>
@endsection