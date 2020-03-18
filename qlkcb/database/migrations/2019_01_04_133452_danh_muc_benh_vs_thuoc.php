<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhMucBenhVsThuoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_benh_vs_thuoc', function (Blueprint $table) {
            $table->string('IdBenh', 15)->primary()->comment("Mã danh mục bệnh");
            $table->string("IdThuoc", 15)->comment("Mã danh mục thuốc");
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
        Schema::dropIfExists('danh_muc_benh_vs_thuoc');
    }
}
