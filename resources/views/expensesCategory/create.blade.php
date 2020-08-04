@extends('layouts.app')

@section('content')
    <h1>Create Expense Category</h1>
    {!! Form::open(['action' => 'ExpensesCategoryController@store','method' => 'POST']) !!}
     
    <div class="form-group">
        {{Form::label('name', 'name')}}
        {{Form::text('name','',['class'=>'form-control','placeholder' => 'Enter the expense category name'])}}
    </div>

    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}    
@endsection
