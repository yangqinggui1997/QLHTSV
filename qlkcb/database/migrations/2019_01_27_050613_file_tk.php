<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileTk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_tk', function (Blueprint $table) {
            $table->string('IdFile', 15)->primary()->comment("Mã file");
            $table->string("IdTK", 15)->comment("Mã thống kê");
            $table->mediumText("TenFile")->comment("Tên file");
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
        Schema::dropIfExists('file_tk');
    }
}
