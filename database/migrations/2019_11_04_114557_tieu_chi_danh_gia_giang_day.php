<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TieuChiDanhGiaGiangDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin các tiêu chí đánh giá giảng dạy*/
        Schema::create('tieu_chi_danh_gia_giang_day', function (Blueprint $table) {               
            $table->string("idTCDGGD", 15)->primary()->comment("Mã tiêu chí đánh giá giảng dạy");
            $table->string("tenTCDGGD", 500)->comment("Tên tiêu chí đánh giá giảng dạy");
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
        Schema::dropIfExists('tieu_chi_danh_gia_giang_day');
    }
}
