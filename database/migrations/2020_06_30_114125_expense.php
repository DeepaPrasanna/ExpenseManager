<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Expense extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            ;

            $table->integer('expense_category_id')->unsigned()->default(1);
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
            ;

            $table->integer('amount');
            $table->string('category');
            $table->string("description");
            $table->string('expense_bill');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     **/

    public function down()
    {
        //
        Schema::dropIfExists('expenses');
    }
}
