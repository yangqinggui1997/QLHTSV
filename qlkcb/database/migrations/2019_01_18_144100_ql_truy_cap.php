<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlTruyCap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ql_truy_cap', function (Blueprint $table) {
            $table->string('IdQLTT', 15)->primary()->comment("Mã truy cập");
            $table->unsignedInteger('IdUser')->comment("Mã người dùng");
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
        Schema::dropIfExists('ql_truy_cap');
    }
}
