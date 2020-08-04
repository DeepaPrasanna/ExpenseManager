@extends('layouts.app')

@section('content')
<a href="/expense_categories" class="btn btn-light">Go back</a>
<h1>{{$categories->name}}</h1>
<div>
<hr>
<small>{{$categories->created_at}} by {{$categories->name}}</small>
<hr>
@if(!Auth::guest())

    <a href="/expense_categories/{{$categories->id}}/edit" class="btn btn-light">Edit</a>

    {!!Form::open(['action'=>['ExpensesCategoryController@destroy',$categories->id],'method'=>'POST', 'class'=>"float-right"])!!}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
    {!!Form::close()!!}

@endif
@endsection
