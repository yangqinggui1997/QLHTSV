<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChuanDoanVSBenhAnNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuan_doan_vs_benh_an_noi_tru', function (Blueprint $table) {
            $table->string('IdBANoiT', 15)->primary()->comment("Mã bệnh án nội trú");
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
        Schema::dropIfExists('chuan_doan_vs_benh_an_noi_tru');
    }
}
