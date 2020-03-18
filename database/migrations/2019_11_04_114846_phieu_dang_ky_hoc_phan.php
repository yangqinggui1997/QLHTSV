<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDangKyHocPhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin đăng ký học phần của sinh viên*/
        Schema::create('phieu_dang_ky_hoc_phan', function (Blueprint $table) {    
            $table->string("idHP", 15)->comment("Mã học phần");
            $table->string("idGV", 15)->comment("Mã giảng viên");
            $table->string("idUser", 15)->primary()->comment("Mã người dùng");
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idLop", 15)->comment("Mã lớp học của sinh viên");
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
        Schema::dropIfExists('phieu_dang_ky_hoc_phan');
    }
}
