<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HoaDonDvNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don_dv_ngoai_tru', function (Blueprint $table) {
            $table->string('IdHDDVNgoai', 15)->primary()->comment("Mã hóa đơn dịch vụ ngoại trú");
            $table->string("IdNVLap", 15)->comment("Mã nhân viên lập");
            $table->string("IdBANgoaiT", 15)->comment("Mã bệnh án nội trú");
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
        Schema::dropIfExists('hoa_don_dv_ngoai_tru');
    }
}
