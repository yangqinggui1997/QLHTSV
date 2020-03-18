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
        /*Chứa thông tin quận huyện*/
        Schema::create("quan__huyen", function(Blueprint $table){
            $table->string("idHuyen", 15)->primary()->comment("Mã quận huyện");
            $table->string("idTinh", 15)->comment("Mã tỉnh thành phố");
            $table->string("tenHuyen")->comment("Tên quận huyện");
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
        Schema::dropIfExists("quan__huyen");
    }
}
