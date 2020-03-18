<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhuongXa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phuong_xa', function (Blueprint $table) {
            $table->string('IdXa', 15)->primary()->comment("Mã xã phường");
            $table->string("IdHuyen", 15)->comment("Mã huyện trực thuộc");
            $table->text("TenXa")->comment("Tên xã");
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
        Schema::dropIfExists('phuong_xa');
    }
}
