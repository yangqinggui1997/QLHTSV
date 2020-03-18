<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HocPhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin học phần*/
        Schema::create('hoc_phan', function (Blueprint $table) {
            $table->string('idHP', 15)->primary()->comment("Mã học phần");
            $table->string('tenHP', 500)->comment("Tên học phần");
            $table->unsignedTinyInteger("STC")->comment("Số tín chỉ");
            $table->unsignedTinyInteger("soTietLT")->comment("Số tiết lý thuyết");
            $table->unsignedTinyInteger("soTietTH")->comment("Số tiết thực hành");
            $table->unsignedTinyInteger("phanTramDiemTX")->comment("Phần trăm điểm thường xuyên");
            $table->unsignedTinyInteger("phanTramDiemThi")->comment("Phần trăm điểm thi");
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
        Schema::dropIfExists('hoc_phan');
    }
}
