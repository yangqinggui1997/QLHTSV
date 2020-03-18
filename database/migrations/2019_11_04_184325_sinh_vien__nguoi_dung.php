<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhVienNguoiDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Bảng quan hệ giữa cán bộ, giảng viên và sinh viên với tài khoản hệ thống của họ*/
        Schema::create('sinh_vien__nguoi_dung', function (Blueprint $table) {
            $table->string("idUser", 15)->primary()->comment("Mã người dùng");
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
        Schema::dropIfExists('sinh_vien__nguoi_dung');
    }
}
