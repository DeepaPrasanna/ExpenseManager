<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ApiExpenseController extends Controller
{
    public function getAllExpenses()
    {

        // logic to get all expenses goes here
        $expense = Expense::get()->toJson(JSON_PRETTY_PRINT);
        return response($expense, 200);
    }
    
    public function createExpense(Request $request)
    {

        // logic to create an expense record goes here
        $expense = new Expense;
        $expense->amount = $request->input('amount');
        $expense->category = $request->input('category');
        $expense->description = $request->input('description');
        $expense->expense_bill = $request->input('expense_bill');


        $expense->user_id = $request->input('user_id');
        // $expense->expense_category_id = $request->input('category');
        $expense->expense_category_id = $request->input('expense_category_id');


        $expense->save();
    
        return response()->json([
            "message" => "expense record created"
        ], 201);
    }

    public function getExpense($id)
    {
        // logic to get an expense record goes here
        if (Expense::where('id', $id)->exists()) {
            $expense = Expense::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($expense, 200);
        } else {
            return response()->json([
              "message" => "Expense not found"
            ], 404);
        }
    }
  
    public function updateExpense(Request $request, $id)
    {
        // logic to update an expense record goes here
        if (Expense::where('id', $id)->exists()) {
            $expense = Expense::find($id);
            $expense->amount = is_null($request->amount) ? $expense->amount : $expense->amount;
            $expense->category = is_null($request->category) ? $expense->category : $request->category;
            $expense->description = is_null($request->description) ? $expense->description : $request->description;
            $expense->expense_bill = is_null($request->expense_bill) ? $expense->expense_bill : $request->expense_bill;
            $expense->user_id = is_null($request->user_id) ? $expense->user_id : $request->user_id;
            $expense->expense_category_id = is_null($request->expense_category_id) ? $expense->expense_category_id : $request->expense_category_id;

            $expense->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Expense not found"
            ], 404);
        }
    }
  
    public function deleteExpense($id)
    {
        // logic to delete an expense record goes here
        if (Expense::where('id', $id)->exists()) {
            $expense = Expense::find($id);
            $expense->delete();
    
            return response()->json([
              "message" => "Expense record deleted"
            ], 202);
        } else {
            return response()->json([
              "message" => "Expense not found"
            ], 404);
        }
    }
}
