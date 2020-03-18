<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BangDiemDuoi1Tiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Bảng điểm dưới 1 tiết của sinh viên theo học phần và học kỳ*/
        Schema::create('bang_diem_duoi_1_tiet', function (Blueprint $table) {
            $table->string("idDD1T", 15)->primary()->comment("Mã điểm dưới 1 tiết");
            $table->string("idHP", 15)->comment("Mã học phần");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->unsignedTinyInteger("diem")->comment("Điểm số");
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
        Schema::dropIfExists('bang_diem_duoi_1_tiet');
    }
}
