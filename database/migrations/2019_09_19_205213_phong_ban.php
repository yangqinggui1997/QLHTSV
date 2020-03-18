<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhongBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin phòng ban hoặc bộ môn*/
        Schema::create('phong_ban', function (Blueprint $table) {
            $table->string("idPhong")->primary()->comment("Mã phòng ban hoặc bộ môn");
            $table->string("idKhoa")->comment("Mã khoa");
            $table->string("tenPhong")->comment("Tên phòng ban hoặc bộ môn");
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
        Schema::dropIfExists("phong_ban");
    }
}
