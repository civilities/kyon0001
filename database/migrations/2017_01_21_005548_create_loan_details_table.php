<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Loan_id')->comment('借款ID');
            $table->integer('operation')->comment('操作类型');
            $table->integer('operator')->comment('操作者');
            $table->date('next_repayment')->comment('下次应还款时间');
            $table->integer('remain')->comment('剩余应还金额');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_details');
    }
}
