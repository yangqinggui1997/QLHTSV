<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongBaoBieuMauDangXml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_bao__bieu_mau_dang_xml', function (Blueprint $table) {
            $table->unsignedBigInteger('idTB')->primary()->comment("Mã thông báo");
            $table->unsignedBigInteger('idBM')->comment("Mã biểu mẫu dạng xml");
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
        Schema::dropIfExists('thong_bao__bieu_mau_dang_xml');
    }
}
