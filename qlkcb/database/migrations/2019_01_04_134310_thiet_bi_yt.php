<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThietBiYt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thiet_bi_yt', function (Blueprint $table) {
            $table->string('IdTB', 15)->primary()->comment("Mã thiết bị y tế");
            $table->string('IdPB', 15)->comment("Mã phòng ban");
            $table->text("TenTB")->comment("Tên thiết bị");
            $table->text("TenKDau")->comment("Tên thiết bị không dấu");
            $table->text("NSX")->comment("Nhà sản xuất");
            $table->text("NCU")->comment("Nhà cung ứng");
            $table->timestamp("NgayNhap")->useCurrent()->comment("Ngày nhập");
            $table->unsignedInteger("DonGiaNhap")->comment("Đơn giá nhập");
            $table->mediumText("ChucNang")->comment("Chức năng");
            $table->string("PhanLoai")->comment("Phân loại để biết chức năng của thiết bị");
            $table->string("SoTB", 10)->comment("Số thiết bị");
            $table->boolean("TinhTrangSD")->unsigned()->comment("TinhTrangSD");
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
        Schema::dropIfExists('thiet_bi_yt');
    }
}
