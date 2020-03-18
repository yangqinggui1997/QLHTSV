<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenhNhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benh_nhan', function (Blueprint $table) {
            $table->string('IdBN', 15)->primary()->comment("Mã bệnh nhân");
            $table->string("IdXa", 15)->comment("Mã xã phường");
            $table->text("HoTen")->comment("Họ tên bệnh nhân");
            $table->timestamp("NgaySinh")->useCurrent()->comment("Ngày sinh");
            $table->boolean("GioiTinh")->unsigned()->comment("Giới tính");
            $table->string("SoCMND", 9)->nullable()->comment("Số chứng minh nhân dân"); 
            $table->string('SDT', 10)->nullable()->comment("Số điện thoại");
            $table->mediumText("DiaChi")->nullable()->comment("Địa chỉ");
            $table->string("DanToc")->nullable()->comment("Dân tộc");
            $table->mediumText("Anh")->nullable()->comment("Ảnh bệnh nhân");
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
        Schema::dropIfExists('benh_nhan');
    }
}
