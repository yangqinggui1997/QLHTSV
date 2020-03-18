<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TcdgdrlSinhVienChiTiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin chi tiết các tiêu chí đánh giá điểm rèn luyện sinh viên*/
        Schema::create('tcdgdrl_sinh_vien_chi_tiet', function (Blueprint $table) {      
            $table->string("idTCDGCT", 15)->primary()->comment("Mã tiêu chí đánh giá điểm rèn luyện chi tiết");
            $table->string("idTCDG", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện");
            $table->string("tenTCDGCT", 500)->comment("Tên tiêu chí đánh giá điểm rèn luyện chi tiết");
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
        Schema::dropIfExists('tcdgdrl_sinh_vien_chi_tiet');
    }
}
