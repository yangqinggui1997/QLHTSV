<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDanhGiaDiemRenLuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin đánh giá điểm rèn luyện của sinh viên*/
        Schema::create('phieu_danh_gia_diem_ren_luyen', function (Blueprint $table) {
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idUser", 15)->primary()->comment("Mã người dùng");
            $table->string("idTCDG", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện");
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
        Schema::dropIfExists('phieu_danh_gia_diem_ren_luyen');
    }
}
