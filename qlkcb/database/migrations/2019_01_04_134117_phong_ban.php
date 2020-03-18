<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhongBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phong_ban', function (Blueprint $table) {
            $table->string('IdPB', 15)->primary()->comment("Mã phòng ban");
            $table->text("TenPhong")->comment("Tên phòng");
            $table->text("TenKDau")->comment("Tên phòng không dấu");
            $table->string("IdKhoa", 15)->comment("Mã khoa trực thuộc");
            $table->string("PhanLoai")->comment("Phân loại để biét chức năng của phòng");
            $table->unsignedSmallInteger("SoPhong")->comment("Số phòng");
            $table->mediumText("ChucNang")->comment("Chức năng của phòng ban");
            $table->unsignedTinyInteger("Tang")->comment("Tầng lầu của phòng ban");
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
        Schema::dropIfExists('phong_ban');
    }
}
