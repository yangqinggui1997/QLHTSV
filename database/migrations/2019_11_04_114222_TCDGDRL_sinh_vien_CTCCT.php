<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TcdgdrlSinhVienCtcct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin chi tiết của chi tiết các tiêu chí đánh giá điểm rèn luyện sinh viên*/
        Schema::create('tcdgdrl_sinh_vien_ctcct', function (Blueprint $table) {
            $table->string("idTCDGCTCCT", 15)->primary()->comment("Mã tiêu chí đánh giá điểm rèn luyện chi tiết của chi tiết");
            $table->string("idTCDGCT", 15)->comment("Mã tiêu chí đánh giá điểm rèn luyện chi tiết");
            $table->string("tenTCDGCTCCT", 500)->comment("Tên tiêu chí đánh giá điểm rèn luyện chi tiết của chi tiết");
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
        Schema::dropIfExists('tcdgdrl_sinh_vien_ctcct');
    }
}
