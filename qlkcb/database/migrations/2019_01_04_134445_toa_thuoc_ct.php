<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToaThuocCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toa_thuoc_ct', function (Blueprint $table) {
            $table->string('IdTT', 15)->primary()->comment("Mã đối tượng tham chiếu (toa thuốc ngoại trú hoặc nội trú chi tiết)");
            $table->string("IdThuoc", 15)->comment("Mã danh mục thuốc");
            $table->unsignedSmallInteger("SoNgayDung")->comment("Số ngày dùng thuốc");
            $table->unsignedSmallInteger("TST")->comment("Tổng số thuốc");
            $table->string("LieuDung")->comment("Liều dùng trong ngày");
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
        Schema::dropIfExists('toa_thuoc_ct');
    }
}
