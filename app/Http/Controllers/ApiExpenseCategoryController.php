<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;

class ApiExpenseCategoryController extends Controller
{
    //
    public function getAllExpensesCategory()
    {

        // logic to get all expenses  category goes here
        $expenseCategory = ExpenseCategory::get()->toJson(JSON_PRETTY_PRINT);
        return response($expenseCategory, 200);
    }
    
    public function createExpenseCategory(Request $request)
    {

        // logic to create an expense  category record goes here
        $expenseCategory = new ExpenseCategory;
        $expenseCategory->name = $request->input('name');
        $expenseCategory->save();
    
        return response()->json([
            "message" => "expense Category record created"
        ], 201);
    }

    public function getExpenseCategory($id)
    {
        // logic to get an expense record goes here
        if (ExpenseCategory::where('id', $id)->exists()) {
            $expenseCategory = ExpenseCategory::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($expenseCategory, 200);
        } else {
            return response()->json([
              "message" => "Expense Category not found"
            ], 404);
        }
    }
  
    public function updateExpenseCategory(Request $request, $id)
    {
        // logic to update an expense category  record goes here
        if (ExpenseCategory::where('id', $id)->exists()) {
            $expenseCategory = ExpenseCategory::find($id);
            $expenseCategory->name = is_null($request->name) ? $expenseCategory->name : $request->name;


            $expenseCategory->save();
    
            return response()->json([
                "message" => "expense Category record updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Expense Category not found"
            ], 404);
        }
    }
  
    public function deleteExpenseCategory($id)
    {
        // logic to delete an expense category record goes here
        if (ExpenseCategory::where('id', $id)->exists()) {
            $expenseCategory = ExpenseCategory::find($id);
            $expenseCategory->delete();
    
            return response()->json([
              "message" => "Expense Category record deleted"
            ], 202);
        } else {
            return response()->json([
              "message" => "Expense Category record not found"
            ], 404);
        }
    }
}
