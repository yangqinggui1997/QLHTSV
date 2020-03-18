<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BieuMauDangXmlNguoiDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Cho biết người dùng nào có nhu cầu phát sinh dữ liệu từ biểu mẫu dạng bảng, các input của biểu mẫu sẽ có các trường tương ứng trên biểu mẫu dạng xml*/
        Schema::create('bieu_mau_dang_xml__nguoi_dung', function (Blueprint $table) {
            $table->unsignedBigInteger("idBM")->primary()->comment("Mã biểu mẫu");
            $table->string("idUser", 15)->comment("Mã người dùng");
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
        Schema::dropIfExists('bieu_mau_dang_xml__nguoi_dung');
    }
}
