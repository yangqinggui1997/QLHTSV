<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChuongTrinhDaoTao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chương trình đào tạo*/
        Schema::create('chuong_trinh_dao_tao', function (Blueprint $table) {
            $table->string("idCTDT", 300)->primary()->comment("Mã chương trình đào tạo");
            $table->string("idPhong")->comment("Mã phòng ban hoặc bộ môn");
            $table->string("heDaoTao", 50)->comment("Hệ đào tạo");
            $table->unsignedTinyInteger("capHDT")->comment("Phân cấp hệ đào tạo");
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
        Schema::dropIfExists('chuong_trinh_dao_tao');
    }
}
