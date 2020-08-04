<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = Expense::orderBy('created_at', 'desc')->paginate(3);


        return view('expenses.index')->with('expenses', $expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $expenseCategory = ExpenseCategory::all();
       
        $categories = [];
        foreach ($expenseCategory as $category) {
            $categories[$category->id] = $category->name;
        }
        // print_r($categories);
        // exit;
        return view('expenses.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            "amount"=>'required',
            "category" =>'required',
            "description"=>'required',
            "expense_bill" =>'required'

        ]);

        $expense = new Expense;
        $expense->amount = $request->input('amount');
        $expense->category = $request->input('category');
        $expense->description = $request->input('description');
        $expense->expense_bill = $request->input('expense_bill');


        $expense->user_id = auth()->user()->id;
        $expense->expense_category_id = $request->input('category');

        $expense->save();

        return redirect('/expenses')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $expenses = Expense::find($id);
        return view('expenses.show')->with('expenses', $expenses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $expenses= Expense::find($id);
        //check for correct user
        if (auth()->user()->id !== $expenses->user_id) {
            return redirect('/expenses')->with('error', 'unauthorized page');
        }
        $expenseCategory = ExpenseCategory::all();
        $categories = [];
        foreach ($expenseCategory as $category) {
            $categories[$category->id] = $category->name;
        }
        // return $expenseCategory;
        return view('expenses.edit')->with('expenses', $expenses)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            "amount"=>'required',
            // "category" =>'required'
        ]);

        $expense = new Expense;
        $expense->amount = $request->input('amount');
        $expense->category = $request->input('category');
        $expense->description = $request->input('description');
        $expense->expense_bill = $request->input('expense_bill');
        $expense->expense_category_id = $request->input('category');



        // $post->user_id = auth()->user()->id;
        $expense->save();

        return redirect('/home')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $expenses = Expense::find($id);
        //check for correct user
        if (auth()->user()->id !== $expenses->user_id) {
            return redirect('/expenses')->with('error', 'unauthorized page');
        }
        $expenses->delete();
        return redirect('/home')->with('success', 'Expense deleted');
    }
}
