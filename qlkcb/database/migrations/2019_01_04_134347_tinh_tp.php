<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TinhTp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinh_tp', function (Blueprint $table) {
            $table->string('IdTinh', 15)->primary()->comment("Mã tỉnh thành phố");
            $table->text("TenTinh")->comment("Tên tỉnh");
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
        Schema::dropIfExists('tinh_tp');
    }
}
