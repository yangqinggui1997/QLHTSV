<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BenhAnNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benh_an_ngoai_tru', function (Blueprint $table) {
            $table->string('IdBANgoaiT', 15)->primary()->comment("Mã hồ sơ bệnh án");
            $table->string("IdNV", 15)->comment("Mã nhân viên");
            $table->unsignedSmallInteger("SoNgayDT")->comment("Số ngày điều trị");
            $table->boolean('TrangThaiBA')->unsigned()->comment("Trạng thái bệnh án cho biết bệnh nhân đang điều trị hoặc đã kết thúc điều trị");
            $table->boolean('TinhTrangTT')->unsigned()->comment("Tình trạng thanh toán viện phí của bệnh nhân (cập nhật bởi kế toán)");
            $table->string("TTBN")->comment("Tình trạng bệnh nhân lúc tiếp nhận");
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
        Schema::dropIfExists('benh_an_ngoai_tru');
    }
}
