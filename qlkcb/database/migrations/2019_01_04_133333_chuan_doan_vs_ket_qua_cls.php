<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChuanDoanVSKetQuaCLS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuan_doan_vs_ket_qua_cls', function (Blueprint $table) {
            $table->string('IdKQCLS', 15)->primary()->comment("Mã kết quả cận lâm sàng");
            $table->string("IdBenh", 15)->comment("Mã danh mục bệnh");
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
        Schema::dropIfExists('chuan_doan_vs_ket_qua_cls');
    }
}
