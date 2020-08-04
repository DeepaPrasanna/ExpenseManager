@extends('layouts.app')

@section('content')
    <h1>Edit Expense Category</h1>
    {!! Form::open(['action' => ['ExpensesCategoryController@update',$categories->id],'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Title')}}
        {{Form::text('name',$categories->name,['class'=>'form-control','placeholder' => 'Title'])}}
    </div>
   
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection
