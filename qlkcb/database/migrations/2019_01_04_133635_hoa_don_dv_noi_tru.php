<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HoaDonDvNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don_dv_noi_tru', function (Blueprint $table) {
            $table->string('IdHDDVNoi', 15)->primary()->comment("Mã hóa đơn dịch vụ nội trú");
            $table->string("IdNVLap", 15)->comment("Mã nhân viên lập");
            $table->string("IdBANoiT", 15)->comment("Mã bệnh án ngoại trú");
            $table->boolean("HinhThucTT")->unsigned()->comment("Hình thức thanh toán hóa đơn");
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
        Schema::dropIfExists('hoa_don_dv_noi_tru');
    }
}
