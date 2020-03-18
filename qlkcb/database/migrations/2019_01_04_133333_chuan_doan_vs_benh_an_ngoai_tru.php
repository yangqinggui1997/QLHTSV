<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChuanDoanVSBenhAnNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuan_doan_vs_benh_an_ngoai_tru', function (Blueprint $table) {
            $table->string('IdBANgoaiT', 15)->primary()->comment("Mã bệnh án ngoại trú");
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
        Schema::dropIfExists('chuan_doan_vs_benh_an_ngoai_tru');
    }
}
