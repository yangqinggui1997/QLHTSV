<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongBaoKhoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_bao__khoa', function (Blueprint $table) {
            $table->unsignedBigInteger('idTB', FALSE)->primary()->comment("Mã thông báo");
            $table->string("idKhoa")->comment("Mã khoa");
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
        Schema::dropIfExists('thong_bao__khoa');
    }
}
