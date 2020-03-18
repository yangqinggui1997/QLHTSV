<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HocKyHocTapSinhVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa tin từng học kỳ học tập của sinh viên*/
        Schema::create('hoc_ky_hoc_tap_sinh_vien', function (Blueprint $table) {
            $table->string("idHKSV", 5)->primary()->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("namHocTT", 5)->comment("Năm học trên thời gian thực tế");
            $table->string("namHocCT", 5)->comment("Năm học theo chương trình");
            $table->string("hocKy", 5)->comment("Học kỳ");
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
        Schema::dropIfExists('hoc_ky_hoc_tap_sinh_vien');
    }
}
