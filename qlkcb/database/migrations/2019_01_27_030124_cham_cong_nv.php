<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChamCongNv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cham_cong_nv', function (Blueprint $table) {
            $table->string('IdCC', 15)->primary()->comment("Mã chấm công");
            $table->string('IdNV', 15)->comment("Mã nhân viên");
            $table->boolean("TrangThai")->unsigned()->comment("Trạng thái tính lương");
            $table->unsignedTinyInteger("SoNgayCong")->comment("Số ngày công");
            $table->unsignedInteger("Thuong")->comment("Tiền thưởng");
            $table->unsignedInteger("TienPhat")->comment("Tiền phạt");
            $table->boolean("TTCN")->unsigned()->comment("Trạng thái cập nhật");
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
        Schema::dropIfExists('cham_cong_nv');
    }
}
