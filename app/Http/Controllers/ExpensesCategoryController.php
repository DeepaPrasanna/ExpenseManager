<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Illuminate\Http\Request;

class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = ExpenseCategory::orderBy('created_at','desc')->paginate(2);


        return view('expensesCategory.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expensesCategory.create');
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
        $this->validate($request,[
            "name"=>'required',
        ]);

        $categories = new ExpenseCategory;
        $categories->name = $request->input('name');
        $categories->save();

        return redirect('/expense_categories')->with('success','Category created');
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
        $categories= ExpenseCategory::find($id);
        return view('expensesCategory.show')->with('categories',$categories);
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
        $categories= ExpenseCategory::find($id);
        
        return view('expensesCategory.edit')->with('categories',$categories);
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
        $this->validate($request,[
            "name"=>'required',
        ]);

        $categories = new ExpenseCategory;
        $categories->name = $request->input('name');
        $categories->save();

        return redirect('/expense_categories')->with('success','Category updated');

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
        $categories = ExpenseCategory::find($id);
        $categories->delete();
        return redirect('/expense_categories')->with('success','Category deleted');

    }
}
