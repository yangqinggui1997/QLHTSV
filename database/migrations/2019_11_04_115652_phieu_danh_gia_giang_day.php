<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDanhGiaGiangDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Đánh giá giảng dạy của giảng viên*/
        Schema::create('phieu_danh_gia_giang_day', function (Blueprint $table) {
            $table->string("idHP", 15)->primary()->comment("Mã học phần");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idTCDGGD", 15)->comment("Mã tiêu chí đánh giá giảng dạy");
            $table->unsignedTinyInteger("diem")->comment("Điểm số");
            $table->text("kienNghi")->comment("Kiến nghị");
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
        Schema::dropIfExists('phieu_danh_gia_giang_day');
    }
}
