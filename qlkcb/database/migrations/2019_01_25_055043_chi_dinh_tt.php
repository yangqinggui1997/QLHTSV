<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChiDinhTt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_dinh_tt', function (Blueprint $table) {
            $table->string('IdThuThuat', 15)->primary()->comment("Mã phiếu chỉ định thủ thuật");
            $table->string("IdNVTH", 15)->comment("Mã nhân viên thực hiện");
            $table->string("IdPB", 15)->comment("Mã phòng thực hiện");
            $table->string("IdDMCLS", 15)->comment("Mã thủ thuật");
            $table->boolean("TinhTrangTT")->unsigned()->comment("Tình trạng thanh toán phí dịch vụ");
            $table->boolean("TamUng")->unsigned()->comment("Tình trạng đóng phí tạm ứng");
            $table->boolean("LoaiCD")->unsigned()->comment("Loại chỉ định (thường hoặc khẩn)");
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
        Schema::dropIfExists('chi_dinh_tt');
    }
}
