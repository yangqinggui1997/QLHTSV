<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongBaoVanBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_bao__van_ban', function (Blueprint $table) {
            $table->unsignedBigInteger('idTB')->primary()->comment("Mã thông báo");
            $table->unsignedBigInteger('idVB')->comment("Mã văn bản");
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
        Schema::dropIfExists('thong_bao__van_ban');
    }
}
