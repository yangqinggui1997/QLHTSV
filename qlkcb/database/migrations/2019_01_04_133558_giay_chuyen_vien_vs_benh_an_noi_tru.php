<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GiayChuyenVienVSBenhAnNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('giay_chuyen_vien_vs_benh_an_noi_tru', function (Blueprint $table) {
            $table->string('IdGCVNoi', 15)->primary()->comment("Mã giấy chuyển viện");
            $table->string("IdBANoiT", 15)->comment("Mã bệnh án nội trú");
            $table->text('NoiChuyen')->comment('Nơi chuyển đến');
            $table->text('DHLS')->comment('Dấu hiệu lâm sàng');
            $table->text('HDT')->comment('Hướng điều trị');
            $table->string('TTLucChuyen')->comment('Tình trạng lúc chuyển');
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
        //
        Schema::dropIfExists('giay_chuyen_vien_vs_benh_an_noi_tru');
    }
}
