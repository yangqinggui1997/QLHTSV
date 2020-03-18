<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DuyetTk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duyet_tk', function (Blueprint $table) {
            $table->string('IdTK', 15)->primary()->comment("Mã thống kê");
            $table->string("IdNV", 15)->comment("Mã nhân viên duyệt");
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
        Schema::dropIfExists('duyet_tk');
    }
}
