<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('User_id')->comment('审核员ID');
            $table->integer('Customer_id')->comment('用户ID');
            $table->string('amount')->comment('借出金额');
            $table->string('out_time')->comment('借出日期');
            $table->string('back_time')->comment('合同还款日期');
            $table->string('get_time')->nullable()->comment('实际还款日期');
            $table->integer('status')->default(0)->comment('借款状态 0借出,1还清,2逾期');
            $table->integer('back_way')->nullable()->comment('还款渠道');
            $table->integer('remain')->nullable()->comment('剩余需还金额');
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
        Schema::dropIfExists('loans');
    }
}
