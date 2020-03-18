<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuanHuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quan_huyen', function (Blueprint $table) {
            $table->string('IdHuyen', 15)->primary()->comment("Mã quận huyện");
            $table->string("IdTinh", 15)->comment("Mã tỉnh trực thuộc");
            $table->text("TenHuyen")->comment("Tên huyện");
            $table->text("TenKDau")->comment("Tên không dấu");
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
        Schema::dropIfExists('quan_huyen');
    }
}
