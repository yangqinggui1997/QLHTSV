<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChucVuVsNv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuc_vu_vs_nv', function (Blueprint $table) {
            $table->string('IdCV')->primary()->comment("Mã chức vụ");
            $table->string("IdNV", 15)->comment("Mã nhân viên");
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
        Schema::dropIfExists('chuc_vu_vs_nv');
    }
}
