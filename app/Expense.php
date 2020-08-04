<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    // protected $fillable = [
    //     'user_id', 'expense_category_id', 'amount', 'category', 'description',expense_bill,
    // ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function expenseCategory()
    {
        return $this->belongsTo('App\ExpenseCategory');
    }
}
