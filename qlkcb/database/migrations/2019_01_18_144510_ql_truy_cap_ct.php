<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlTruyCapCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ql_truy_cap_ct', function (Blueprint $table) {
            $table->string('IdQLTTCT', 15)->primary()->comment("Mã truy cập chi tiết");
            $table->string('IdQLTT', 15)->comment("Mã truy cập");
            $table->string('DMTT')->comment("Danh mục truy cập");
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
        Schema::dropIfExists('ql_truy_cap_ct');
    }
}
