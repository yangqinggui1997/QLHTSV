<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HocKyChuongTrinhDaoTao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chương trình đào tạo cho từng học kỳ*/
        Schema::create('hoc_ky__chuong_trinh_dao_tao', function (Blueprint $table) {
            $table->string('idHKDT', 5)->primary()->comment("Mã chương trình đào tạo theo học kỳ");
            $table->string("idCTDT", 300)->comment("Mã chương trình đào tạo");
            $table->string("namHoc", 5)->comment("Năm học");
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
        Schema::dropIfExists('hoc_ky__chuong_trinh_dao_tao');
    }
}
