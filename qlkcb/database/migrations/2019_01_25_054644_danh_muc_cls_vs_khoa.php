<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhmucCLSVSKhoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_cls_vs_khoa', function (Blueprint $table) {
            $table->string('IdKhoa', 15)->primary()->comment("Mã chuyên khoa");
            $table->string("IdDMCLS", 15)->comment("Mã danh mục cận lâm sàng");
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
        Schema::dropIfExists('danh_muc_cls_vs_khoa');
    }
}
