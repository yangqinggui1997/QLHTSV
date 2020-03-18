<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin lớp thuộc về một chương trình đào tạo*/
        Schema::create('lop', function (Blueprint $table) {
            $table->string("idLop", 15)->primary()->comment("Mã lớp học của sinh viên");
            $table->string("idCTDT", 300)->comment("Mã chương trình đào tạo");
            $table->unsignedTinyInteger("STTKhoaDaoTao")->comment("Hệ đào tạo");
            $table->string("nienKhoa", 15)->comment("Niên khoá");
            $table->boolean("trangThai")->comment("Trạng thái hoạt động cua lớp");
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
        Schema::dropIfExists('lop');
    }
}
