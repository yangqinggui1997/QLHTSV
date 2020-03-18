<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class XaPhuongThiTran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin xã phường, thị trấn*/
        Schema::create("xa__phuong__thi_tran", function(Blueprint $table){
            $table->string("idXa", 15)->primary()->comment("Mã xã phường thị trấn");
            $table->string("idHuyen", 15)->comment("Mã quận huyện");
            $table->string("tenXa")->comment("Tên xã");
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
        Schema::dropIfExists("xa__phuong__thi_tran");
    }
}
