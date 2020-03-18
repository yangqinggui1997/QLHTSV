<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuKeKhaiVpNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_ke_khai_vp_noi_tru', function (Blueprint $table) {
            $table->string('IdPKK', 15)->primary()->comment("Mã phiếu kê khai viện phí nội trú");
            $table->string("IdBANoiT", 15)->comment("Mã bệnh án nội trú");
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
        Schema::dropIfExists('phieu_ke_khai_vp_noi_tru');
    }
}
