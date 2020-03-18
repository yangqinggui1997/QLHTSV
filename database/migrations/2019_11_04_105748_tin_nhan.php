<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TinNhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Tin nhắn của người dùng*/
        Schema::create('tin_nhan', function (Blueprint $table) {
            $table->bigIncrements('idTN')->comment("Mã tin nhắn");
            $table->string("idUserGui", 15)->comment("Mã người dùng gửi");
            $table->string("idUserNhan", 15)->comment("Mã người dùng nhận");
            $table->mediumText("noiDung")->comment("Nội dung");
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
        Schema::dropIfExists('tin_nhan');
    }
}
