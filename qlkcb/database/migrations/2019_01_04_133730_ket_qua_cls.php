<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KetQuaCls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_cls', function (Blueprint $table) {
            $table->string('IdKQCLS', 15)->primary()->comment("Mã phiếu kết quả cận lâm sàng");
            $table->string("IdCLS", 15)->comment("Mã phiếu chỉ định cận lâm sàng");
            $table->string("IdNVTH", 15)->comment("Mã nhân viên thực hiện chỉ định cận lâm sàng");
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
        Schema::dropIfExists('ket_qua_cls');
    }
}
