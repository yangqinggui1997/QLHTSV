<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BangDiemThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Bảng điểm thi của sinh viên theo học phần và học kỳ*/
        Schema::create('bang_diem_thi', function (Blueprint $table) {
            $table->string("idDT", 15)->primary()->comment("Mã điểm thi");
            $table->string("idHP", 15)->comment("Mã học phần");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->unsignedTinyInteger("diem")->comment("Điểm số");
            $table->unsignedTinyInteger("lanThi")->comment("Lần thi thứ mấy?");
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
        Schema::dropIfExists('bang_diem_thi');
    }
}
