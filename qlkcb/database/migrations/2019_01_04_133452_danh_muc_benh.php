<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhMucBenh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_benh', function (Blueprint $table) {
            $table->string('IdBenh', 15)->primary()->comment("Mã danh mục bệnh");
            $table->text("TenBenh")->comment("Tên danh mục bệnh");
            $table->text("TenKDau")->comment("Tên bệnh không dấu");
            $table->timestamp("NgayPH")->comment("Ngày phát hiện bệnh");
            $table->mediumText("ChungVSGayBenh")->comment("Tên gọi chủng vi sinh gây bệnh");
            $table->mediumText("TrieuChungLS")->comment("Triệu chứng lâm sàng");
            $table->mediumText("ChungKhang")->comment("Chủng vi sinh kháng bệnh");
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
        Schema::dropIfExists('danh_muc_benh');
    }
}
