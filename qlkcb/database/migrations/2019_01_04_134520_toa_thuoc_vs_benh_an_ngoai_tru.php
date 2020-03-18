<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToaThuocVSBenhAnNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toa_thuoc_vs_benh_an_ngoai_tru', function (Blueprint $table) {
            $table->string('IdTT', 15)->primary()->comment("Mã toa thuốc ngoại trú");
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
        Schema::dropIfExists('toa_thuoc_vs_benh_an_ngoai_tru');
    }
}
