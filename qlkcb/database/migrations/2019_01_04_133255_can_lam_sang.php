<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CanLamSang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_lam_sang', function (Blueprint $table) {
            $table->string('IdCLS', 15)->primary()->comment("Mã phiếu chỉ định cận lâm sàng");
            $table->string('IdDMCLS', 15)->comment("Mã danh mục cận lâm sàng");
            $table->string("IdPB", 15)->comment("Mã phòng thực hiện phiếu chỉ định");
            $table->boolean("TinhTrangTT")->unsigned()->comment("Tình trạng thanh toán phí dịch vụ cận lâm sàng");
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
        Schema::dropIfExists('can_lam_sang');
    }
}
