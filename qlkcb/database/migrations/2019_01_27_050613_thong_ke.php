<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThongKe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_ke', function (Blueprint $table) {
            $table->string('IdTK', 15)->primary()->comment("Mã thống kê");
            $table->string("IdNV", 15)->comment("Mã nhân viên thống kê");
            $table->string("PhanLoai", 255)->comment("Phân loại thống kê)");
            $table->boolean("TTD")->unsigned()->comment("Trạng thái duyệt thống kê");
            $table->mediumText("CD")->comment("Chủ đề file)");
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
        Schema::dropIfExists('thong_ke');
    }
}
