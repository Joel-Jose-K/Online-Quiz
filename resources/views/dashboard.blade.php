@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome to the Quiz!</h1>
    <div class="separator-breadcrumb border-top"></div>

    <a href="{{ route('quiz.type') }}" class="btn btn-primary">Add Quiz Type</a>
    
    <a href="{{ route('quiz.view') }}" class="btn btn-primary">Add Quiz</a>

@endsection

@push('scripts')

@endpush