<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('LoanDetail_id')->comment('借款详情ID');
            $table->integer('days')->comment('延期天数');
            $table->date('begin_date')->comment('延期开始日');
            $table->date('end_date')->comment('延期结束日');
            $table->integer('fee')->comment('延期费');
            $table->string('comment')->comment('延期备注');
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
        Schema::dropIfExists('delays');
    }
}
