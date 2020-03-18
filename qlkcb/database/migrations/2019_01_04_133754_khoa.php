<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Khoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khoa', function (Blueprint $table) {
            $table->string('IdKhoa', 15)->primary()->comment("Mã khoa");
            $table->text("TenKhoa")->comment("Tên khoa");
            $table->text("TenKDau")->comment("Tên khoa không dấu");
            $table->timestamp("NgayTL")->useCurrent()->comment("Ngày thành lập");
            $table->mediumText("ChucNang")->comment("Chức năng của khoa");
            $table->boolean("KhoaKham")->unsigned()->comment("Xác định có phải khoa khám bệnh hay không?");
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
        Schema::dropIfExists('khoa');
    }
}
