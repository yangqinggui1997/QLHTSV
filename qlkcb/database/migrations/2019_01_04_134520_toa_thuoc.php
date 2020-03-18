<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToaThuoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toa_thuoc', function (Blueprint $table) {
            $table->string('IdTT', 15)->primary()->comment("Mã toa thuốc ngoại trú hoặc nội trú");
            $table->boolean('TTLanhThuoc')->unsigned()->comment('Tình trạng lãnh thuốc');
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
        Schema::dropIfExists('toa_thuoc');
    }
}
