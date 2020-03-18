<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDkKhamVsBenhAnNoiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_dk_kham_vs_benh_an_noi_tru', function (Blueprint $table) {
            $table->string('IdPhieuDKKB', 15)->primary()->comment("Mã phiếu đăng ký khám bệnh");
            $table->string("IdBANoiT", 15)->comment("Mã bệnh án nội trú");
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
        Schema::dropIfExists('phieu_dk_kham_vs_benh_an_noi_tru');
    }
}
