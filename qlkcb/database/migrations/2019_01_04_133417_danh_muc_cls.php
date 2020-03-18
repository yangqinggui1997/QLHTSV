<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhmucCls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_cls', function (Blueprint $table) {
            $table->string('IdDMCLS', 15)->primary()->comment("Mã danh mục cận lâm sàng");
            $table->text("TenCLS")->comment("Tên danh mục cận lâm sàng");
            $table->text("TenKDau")->comment("Tên gọi không dấu của danh mục cls");
            $table->string("PhanLoai")->comment("Phân loại cls (thủ thuật, phẫu thuật, siêu âm, ...)");
            $table->string("DonViTinh")->comment("Đơn vị tính");
            $table->unsignedInteger("DonGia")->comment("Đơn giá");
            $table->boolean("DanhMucBHYT")->unsigned()->comment("Có thuộc danh mục BHYT hay ko?");
            $table->unsignedTinyInteger("BHYTTT")->comment("Phần trăm BHYT thanh toán");
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
        Schema::dropIfExists('danh_muc_cls');
    }
}
