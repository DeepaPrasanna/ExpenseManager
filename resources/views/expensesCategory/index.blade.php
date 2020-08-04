@extends('layouts.app')

@section('content')
    <h1>Expense Categories</h1>
    @if (count($categories)>0)
        
            @foreach($categories as $category)
            <div class="card bg-light p-3 mb-2">
            <h3 class="mb-0"><a href="/expense_categories/{{$category->id}}">{{$category->name}}</a><h3>
                <small>written on {{$category->created_at}} by {{$category->name}}</small>
            </div>
            @endforeach
            {{$categories->links()}}

        
    @else
        <p>There are no Expense categories</p>
        
    @endif
    
@endsection
