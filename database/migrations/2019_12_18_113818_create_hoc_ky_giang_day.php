<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocKyGiangDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc_ky_giang_day', function (Blueprint $table) {
            $table->string('idUser', 15)->primary()->comment("Mã người dùng là cán bộ, giảng viên");
            $table->string("namHoc", 5)->comment("Năm học");
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
        Schema::dropIfExists('hoc_ky_giang_day');
    }
}
