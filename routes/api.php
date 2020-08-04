<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/v1/cars', function (Request $request) {return 'From the server: details of two cars';});
//API routes for the users
Route::get('users', 'ApiController@getAllUsers');
Route::get('users/{id}', 'ApiController@getUser');
Route::post('users', 'ApiController@createUser');
Route::put('users/{id}', 'ApiController@updateUser');
Route::delete('users/{id}', 'ApiController@deleteUser');

//API routes for the users expenses

Route::get('expenses', 'ApiExpenseController@getAllExpenses');
Route::get('expenses/{id}', 'ApiExpenseController@getExpense');
Route::post('expenses', 'ApiExpenseController@createExpense');
Route::put('expenses/{id}', 'ApiExpenseController@updateExpense');
Route::delete('expenses/{id}', 'ApiExpenseController@deleteExpense');


//API routes for the users expenses category

Route::get('expensesCategory', 'ApiExpenseCategoryController@getAllExpensesCategory');
Route::get('expensesCategory/{id}', 'ApiExpenseCategoryController@getExpenseCategory');
Route::post('expensesCategory', 'ApiExpenseCategoryController@createExpenseCategory');
Route::put('expensesCategory/{id}', 'ApiExpenseCategoryController@updateExpenseCategory');
Route::delete('expensesCategory/{id}', 'ApiExpenseCategoryController@deleteExpenseCategory');

//API routes for the Login and logout
Route::post('login', 'ApiLoginController@login');
// Route::post('login','Auth\LoginController@login');
//private routes
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'ApiLoginController@logout')->name('logout');
});
