<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDkKhamVsBenhAnNgoaiTru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_dk_kham_vs_benh_an_ngoai_tru', function (Blueprint $table) {
            $table->string('IdPhieuDKKB', 15)->primary()->comment("Mã phiếu đăng ký khám bệnh");
            $table->string("IdBANgoaiT", 15)->comment("Mã bệnh án ngoại trú");
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
        Schema::dropIfExists('phieu_dk_kham_vs_benh_an_ngoai_tru');
    }
}
