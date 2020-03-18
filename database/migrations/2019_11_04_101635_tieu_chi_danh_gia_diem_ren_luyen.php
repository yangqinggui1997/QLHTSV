<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TieuChiDanhGiaDiemRenLuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin về các tiêu chí đánh giá điểm rèn luyện sinh viên*/
        Schema::create('tieu_chi_danh_gia_diem_ren_luyen', function (Blueprint $table) {
            $table->string('idTCDG', 15)->primary()->comment("Mã tiêu chí đánh giá điểm rèn luyện");
            $table->string('tenTCDG', 500)->comment("Tên tiêu chí đánh giá điểm rèn luyện");
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
        Schema::dropIfExists('tieu_chi_danh_gia_diem_ren_luyen');
    }
}
