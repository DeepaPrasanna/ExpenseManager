@extends('layouts.app')

@section('content')
<a href="/expenses" class="btn btn-light">Go back</a>
<h1>{{$expenses->id}}</h1>
<div>
<h3>{!!$expenses->description!!}</h3>
</div>
<hr>
<small>{{$expenses->created_at}} by {{$expenses->id}}</small>
<hr>
@if(!Auth::guest())
    @if(Auth::user()->id == $expenses->user_id)
    <a href="/expenses/{{$expenses->id}}/edit" class="btn btn-light">Edit</a>

    {!!Form::open(['action'=>['ExpenseController@destroy',$expenses->id],'method'=>'POST', 'class'=>"float-right"])!!}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
    {!!Form::close()!!}
    @endif
@endif
@endsection
