<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverduesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overdues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Loan_id')->comment('借款ID');
            $table->integer('days')->comment('逾期天数');
            $table->integer('fee')->comment('逾期费用');
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
        Schema::dropIfExists('overdues');
    }
}
