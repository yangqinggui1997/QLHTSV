<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenhAnNgoaiTruVSCanLamSang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('benh_an_ngoai_tru_vs_can_lam_sang', function (Blueprint $table) {
            $table->string('IdBANgoaiT', 15)->primary()->comment("Mã bệnh án ngoại trú");
            $table->string("IdCLS", 15)->comment("Mã phiếu chỉ định cận lâm sàng");
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
        Schema::dropIfExists("benh_an_ngoai_tru_vs_can_lam_sang");
    }
}
