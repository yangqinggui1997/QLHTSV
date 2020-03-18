<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuKeKhaiVpCTNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_ke_khai_vpct_noi_tru', function (Blueprint $table) {
            $table->string('IdPKKCT', 15)->primary()->comment("Mã phiếu kê khai viện phí chi tiết");
            $table->string('IdPKK', 15)->comment("Mã phiếu kê khai viện phí nội trú");
            
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
        Schema::dropIfExists('phieu_ke_khai_vpct_noi_tru');
    }
}
