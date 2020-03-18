<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuPhanCongCoVanHocTap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_phan_cong_co_van_hoc_tap', function (Blueprint $table) {
            $table->string("idLop", 15)->primary()->comment("Mã lớp học của sinh viên");
            $table->string('idUser', 15)->comment("Mã người dùng");
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
        Schema::dropIfExists('phieu_phan_cong_co_van_hoc_tap');
    }
}
