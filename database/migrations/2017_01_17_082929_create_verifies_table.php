<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifies', function (Blueprint $table) {
            $table->integer('customer_id')->unique()->comment('客户id');
            $table->dateTime('verify_at')->comment('审核时间');
            $table->integer('verify_by')->defalut('0')->comment('审核员,默认为0,无审核员');
            $table->string('comment')->nullable()->comment('备注');
            $table->integer('status')->defalut(0)->comment('审核状态');
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
        Schema::dropIfExists('verifies');
    }
}
