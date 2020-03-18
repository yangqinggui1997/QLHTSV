<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuKeKhaiVpNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_ke_khai_vp_ngoai_tru', function (Blueprint $table) {
            $table->string('IdPKK', 15)->primary()->comment("Mã phiếu kê khai viện phí ngoại trú");
            $table->string("IdBANgoaiT", 15)->comment("Mã bệnh án ngoại trú");
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
        Schema::dropIfExists('phieu_ke_khai_vp_ngoai_tru');
    }
}
