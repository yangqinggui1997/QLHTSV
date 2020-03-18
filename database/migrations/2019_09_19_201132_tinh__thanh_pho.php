<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TinhThanhPho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin tỉnh, thành phố*/
        Schema::create("tinh__thanh_pho", function(Blueprint $table){
            $table->string("idTinh", 15)->primary()->comment("Mã tỉnh thành phố");
            $table->string("tenTinh")->comment("Tên tỉnh thành phố");
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
        Schema::dropIfExists("tinh__thanh_pho");
    }
}
