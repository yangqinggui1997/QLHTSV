<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KetLuanCls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_luan_cls', function (Blueprint $table) {
            $table->string('IdKLCLS', 15)->primary()->comment("Mã kết luận cận lâm sàng");
            $table->string("IdKQCLS", 15)->comment("Mã kết quả cận lâm sàng");
            $table->mediumText("KetLuan")->comment("Kết luận");
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
        Schema::dropIfExists('ket_luan_cls');
    }
}
