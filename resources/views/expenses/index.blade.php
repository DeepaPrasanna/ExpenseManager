@extends('layouts.app')

@section('content')
    <h1>Expense</h1>
    @if (count($expenses)>0)
        
            @foreach($expenses as $expense)
            <div class="card bg-light p-3 mb-2">
            <h3 class="mb-0"><a href="/expenses/{{$expense->id}}">{{$expense->id}}</a><h3>
            <small>written on {{$expense->created_at}} by {{$expense->user_id}}</small>
            </div>
            @endforeach
            {{$expenses->links()}}

        
    @else
        <p>No Expenses created</p>
        
    @endif
    
@endsection
