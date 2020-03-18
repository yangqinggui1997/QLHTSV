<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BaNv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_nv', function (Blueprint $table) {
            $table->string('IdBANoiT', 15)->primary()->comment("Mã bệnh án nội trú");
            $table->string("IdNV", 15)->comment("Mã nhân viên");
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
        Schema::dropIfExists('ba_nv');
    }
}
