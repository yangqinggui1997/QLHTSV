<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuPhanCongGiangDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Phân công giảng viên giảng dạy học phần*/
        Schema::create('phieu_phan_cong_giang_day', function (Blueprint $table) {
            $table->string("idHP", 15)->primary()->comment("Mã học phần");
            $table->string("idUser", 15)->comment("Mã người dùng");
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
        Schema::dropIfExists('phieu_phan_cong_giang_day');
    }
}
