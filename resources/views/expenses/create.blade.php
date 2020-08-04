@extends('layouts.app')

@section('content')
    <h1>Create Expense</h1>
    {{-- <h3>{{$categories}}</h3> --}}
  
    {{-- @php
        // print_r($categories);exit;
    @endphp --}}
    {{-- <h3>{{$data}}</h3> --}}


    {!! Form::open(['action' => 'ExpenseController@store','method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('amount', 'Amount')}}
        {{Form::number('amount','',['class'=>'form-control','placeholder' => 'Enter the amount'])}}
    </div>
    {{-- {{Form::macro('myField', function()
        {
    return '<input type="awesome">';
});}} --}}
    <div class="form-group">
        {{Form::label('category', 'Category')}}
        {{Form::select('category', $categories, 'null', ['placeholder' => 'Pick an Expense Category...'])}}
    </div>
        
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description','',['id' =>'editor','class'=>'form-control','placeholder' => 'Enter the description'])}}
    </div>
    <div class="form-group">
        {{Form::label('expense_bill', 'Expense Bill')}}
        {{Form::text('expense_bill','',['class'=>'form-control','placeholder' => 'Enter the expense bill'])}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error=>{
        console.error(error);
    });                                             
</script>
    
@endsection
