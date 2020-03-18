<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenhAnNoiTruCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benh_an_noi_tru_ct', function (Blueprint $table) {
            $table->string('IdBACT', 15)->primary()->comment("Mã hồ sơ bệnh án chi tiết");
            $table->string("IdBANoiT", 15)->comment("Mã hồ sơ bệnh án");
            $table->string("PPDieuTri")->comment("Phương pháp điều trị");
            $table->timestamp("NgayBD")->useCurrent()->comment("Ngày bắt đầu điều trị");
            $table->timestamp("NgayKT")->useCurrent()->comment("Ngày kết thúc điều trị");
            $table->string("TinhTrangBN")->comment("Tình trang bệnh nhân sau mỗi đợt điều trị"); 
            $table->mediumText("GhiChu")->nullable()->comment("Ghi chú"); 
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
        Schema::dropIfExists('benh_an_noi_tru_ct');
    }
}
