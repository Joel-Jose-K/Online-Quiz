@extends('layouts.app')

@section('title', 'MCQ')

@section('content')
    <h1>MCQ Details</h1>
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
        {{-- <div class="row">
            <div class="col-md-6">1st column</div>
            <div class="col-md-6"> 2nd column</div>
        </div> --}}
        <br>
    


    {{-- <table class="table">
        <thead></thead>
        <tbody>
            <tr>
                <th scope="row">Quiz Type</th>
                <td>Chemistry101</td>   
            </tr>
            <tr>
                <th scope="row">Quiz Title</th>
                <td>Covalent Bonds</td>   
            </tr>
            <tr>
                <th scope="row">Quiz Description</th>
                <td>Covalent Bonds</td>   
            </tr>
            <tr>
                <th scope="row">Active from</th>
                <td>2021-11-10 16:51:00</td>   
            </tr>
            <tr>
                <th scope="row">Active to</th>
                <td>2021-11-11 16:52:00</td>   
            </tr>
        </tbody>
    </table> --}}
@endsection