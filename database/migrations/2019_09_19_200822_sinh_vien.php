<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin sinh viên*/
        Schema::create('sinh_vien', function(Blueprint $table){
            $table->string('idSV', 15)->primary()->comment("Mã sinh viên");
            $table->string('idXa', 15)->comment("Mã xã (phường)");
            $table->string("hoTen")->comment("Họ tên sinh viên");
            $table->date("ngaySinh")->useCurrent()->comment("Ngày sinh");
            $table->boolean("gioiTinh")->unsigned()->comment("Giới tính");
            $table->string("SDT", 15)->comment("Số điện thoại");
            $table->string('email')->unique()->comment("Địa chỉ email");
            $table->string("khoiThi", 100)->comment("Khối thi");
            $table->unsignedTinyInteger("diemDauVao")->comment("Điểm đầu vào");
            $table->string("trangThai", 100)->comment("Trạng thái");
            $table->string("anh")->nullable()->comment("Ảnh sinh viên");
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
        Schema::dropIfExists('sinh_vien');
    }
}
