<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlThaoTac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ql_thao_tac', function (Blueprint $table) {
            $table->string('IdQLThaoTac', 15)->primary()->comment("Mã quản lý thao tác");
            $table->string('IdQLTTCT', 15)->comment("Mã truy cập chi tiết");
            $table->string('TT')->comment("Thao tác");
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
        Schema::dropIfExists('ql_thao_tac');
    }
}
