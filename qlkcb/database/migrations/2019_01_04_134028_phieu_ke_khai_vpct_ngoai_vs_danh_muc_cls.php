<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuKeKhaiVpCTNgoaiVSDanhMucCLS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls', function (Blueprint $table) {
            $table->string('IdPKKCT', 15)->primary()->comment("Mã phiếu kê khai viện phí ngoại trú chi tiết");
            $table->string('IdDMCLS', 15)->comment("Mã danh mục cận lâm sàng");
            $table->unsignedTinyInteger("SL")->comment("Số lượng");
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
        Schema::dropIfExists('phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls');
    }
}
