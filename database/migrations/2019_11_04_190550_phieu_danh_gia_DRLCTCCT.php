<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class phieuDanhGiaDrlctcct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Điểm số của các chi tiết của các chi tiết trên phiếu đánh giá điểm rèn luyện chi tiết*/
        Schema::create('phieu_danh_gia_drlctcct', function (Blueprint $table) {
            $table->string("idHKSV", 5)->primary()->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("idTCDG", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện");
            $table->string("idTCDGCT", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện chi tiết");
            $table->string("idTCDGCTCCT", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện chi tiết của chi tiết");
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
        Schema::dropIfExists('phieu_danh_gia_drlctcct');
    }
}
