@extends('layouts.app')

@section('content')
    <h1>Edit Expense</h1>
    {{-- <h3>{{$categories}}</h3> --}}
    {!! Form::open(['action' => ['ExpenseController@update',$expenses->id],'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('amount', 'Amount')}}
        {{Form::text('amount',$expenses->amount,['class'=>'form-control','placeholder' => 'Amount'])}}
    </div>
    <div class="form-group">
        {{Form::label('category', 'Category')}}
        {{Form::select('category',$categories, $expenses->category, ['placeholder' => 'Pick an Expense Category...'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description',$expenses->description,['id' =>'editor','class'=>'form-control','placeholder' => 'Enter the description'])}}
    </div>
    <div class="form-group">
        {{Form::label('expense_bill', 'Expense Bill')}}
        {{Form::text('expense_bill',$expenses->expense_bill,['class'=>'form-control','placeholder' => 'Enter the expense bill'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
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
