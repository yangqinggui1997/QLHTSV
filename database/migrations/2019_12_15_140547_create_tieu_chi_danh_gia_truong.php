<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTieuChiDanhGiaTruong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tieu_chi_danh_gia_truong', function (Blueprint $table) {
            $table->string('idTCDGT', 15)->primary()->comment("Mã tiêu chí đánh giá trường");
            $table->string('tenTCDGT', 500)->comment("Tên tiêu chí đánh giá trường");
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
        Schema::dropIfExists('tieu_chi_danh_gia_truong');
    }
}
