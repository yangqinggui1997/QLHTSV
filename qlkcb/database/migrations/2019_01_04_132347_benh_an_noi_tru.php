<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenhAnNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('benh_an_noi_tru', function (Blueprint $table) {
            $table->string('IdBANoiT', 15)->primary()->comment("Mã hồ sơ bệnh án");
            $table->string("IdNV", 15)->comment("Mã nhân viên"); 
            $table->string('IdGiuong', 15)->comment("Mã giường bệnh");
            $table->boolean('CapCuu')->unsigned()->comment("Xác định bệnh án có phải cấp cứu");
            $table->string("TTLucVao")->comment("Tình trạng bệnh nhân lúc nhập viện");
            $table->mediumText("LyDoNV")->comment("Lý do nhập viện");
            $table->boolean('TrangThaiBA')->unsigned()->comment("Trạng thái bệnh án cho biết bệnh nhân đang điều trị nội trú hoặc đã kết thúc điều trị");
            $table->boolean('TinhTrangTT')->unsigned()->comment("Tình trạng thanh toán viện phí của bệnh nhân (cập nhật bởi kế toán)");
            $table->mediumText("GhiChu")->nullable()->comment("Ghi chú");
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
        Schema::dropIfExists("benh_an_noi_tru");
    }
}
