<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GiayRaVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giay_ra_vien', function (Blueprint $table) {
            $table->string('IdGRV', 15)->primary()->comment("Mã giấy ra viện");
            $table->string("IdBANoiT", 15)->comment("Mã bệnh án nội trú");
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
        Schema::dropIfExists('giay_ra_vien');
    }
}
