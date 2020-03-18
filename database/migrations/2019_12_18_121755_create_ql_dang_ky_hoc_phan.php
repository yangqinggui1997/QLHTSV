<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQlDangKyHocPhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ql_dang_ky_hoc_phan', function (Blueprint $table) {
            $table->string('namHoc', 15)->primary()->comment("Năm học");
            $table->string('hocKy', 5)->comment("Học kỳ");
            $table->string('khoaDaoTao', 10)->comment("Khoá đào tạo");
            $table->datetime('thoiGianBDDK')->comment("Thời gian bắt đầu đăng ký");
            $table->datetime('thoiGianKTDK')->comment("Thời gian kết thúc đăng ký");
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
        Schema::dropIfExists('ql_dang_ky_hoc_phan');
    }
}
