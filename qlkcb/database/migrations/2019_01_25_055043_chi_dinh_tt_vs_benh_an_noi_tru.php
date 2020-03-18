<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChiDinhTtVSBenhAnNoiTruCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_dinh_tt_vs_benh_an_noi_tru_ct', function (Blueprint $table) {
            $table->string('IdThuThuat', 15)->primary()->comment("Mã phiếu chỉ định thủ thuật");
            $table->string("IdBACT", 15)->comment("Mã bệnh án nội trú chi tiết");
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
        Schema::dropIfExists('chi_dinh_tt_vs_benh_an_noi_tru_ct');
    }
}
