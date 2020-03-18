<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Khoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin khoa*/
        Schema::create('khoa', function (Blueprint $table) {
            $table->string("idKhoa")->primary()->comment("Mã khoa");
            $table->string("tenKhoa")->comment("Tên khoa");
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
        Schema::dropIfExists("khoa");
    }
}
