@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Welcome,{{$name}} to your dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Expenses</h3>
                    @if(count($expenses)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Id no</th>
                                <th>Expense Category</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($expenses as $expense)
                            <tr>
                                <td>{{$expense->id}}</td>
                                <td>{{$expense->category}}</td>
                                <td><a href = "/expenses/{{$expense->id}}/edit" class="btn btn-light">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['ExpenseController@destroy',$expense->id],'method'=>'POST', 'class'=>"float-right"])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            
                            @endforeach

                        </table>
                        @else
                            <p>you have no expenses</p>

                    @endif
                    <a href="/expenses/create" class="btn btn-primary">Create Expense</a>
                    <a href="/expense_categories/create" class="btn btn-success float-right">Add Expense Category</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
