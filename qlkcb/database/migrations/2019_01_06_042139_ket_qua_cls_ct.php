<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KetQuaClsCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_cls_ct', function (Blueprint $table) {
            $table->string('IdKQCLSCT', 15)->primary()->comment("Mã kết quả cận lâm sàng chi tiết");
            $table->string("IdKQCLS", 15)->comment("Mã kết quả cận lâm sàng");
            $table->mediumText("KetQua")->comment("Kết quả thực hiện cận lâm sàng");
            
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
        Schema::dropIfExists('ket_qua_cls_ct');
    }
}
