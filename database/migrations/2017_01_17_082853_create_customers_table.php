<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('客户姓名');
            $table->string('idCard', 255)->unique()->comment('身份证号');
            $table->string('phone', 255)->unique()->comment('客户手机');
            $table->integer('education')->comment('教育程度');
            $table->string('company', 255)->comment('工作单位');
            $table->text('shenfenzheng_img')->comment('身份证图片');
            $table->string('address', 255)->comment('家庭住址');
            $table->string('email', 255)->unique()->comment('电子邮箱');
            $table->string('ip', 255)->comment('ip');
            $table->integer('sex')->comment('性别 1：男 2：女');
            $table->integer('age')->comment('年龄');
            $table->string('hujidizhi', 255)->comment('户籍地址');
            $table->integer('manager')->comment('客户经理');
            $table->string('type')->default('0')->comment('12345对应类型A,B,C,D,N');
            $table->string('wx_openid', 255)->comment('微信ID');
            $table->string('wx_name', 255)->comment('微信昵称');
            $table->string('wx_img', 255)->comment('微信头像');
            $table->string('wx_sex', 255)->comment('微信性别');
            $table->string('wx_addr', 255)->comment('微信地址');
            $table->string('position', 255)->nullable()->comment('定位信息');
            $table->boolean('auth_jd')->default(0)->comment('授权京东');
            $table->boolean('auth_tb')->default(0)->comment('授权淘宝');
            $table->boolean('auth_yys')->default(0)->comment('授权运营商');
            $table->boolean('auth_zfb')->default(0)->comment('授权支付宝');
            $table->integer('money_wanted')->nullable()->comment('客户希望借款数');
            $table->tinyInteger('wangling')->nullable()->comment('网龄');
            $table->integer('zhimafen')->nullable()->comment('芝麻分');
            $table->integer('jdbaitiao')->nullable()->comment('京东白条');
            $table->integer('huabei')->nullable()->comment('花呗额度');
            $table->string('sysAdvice')->comment('系统审核意见');
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
        Schema::dropIfExists('customers');
    }
}
