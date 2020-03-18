<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TamUngPT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tam_ung_pt', function (Blueprint $table) {
            $table->string('IdTA', 15)->primary()->comment("Mã tạm ứng");
            $table->string('IdNVLap', 15)->comment("Mã nhân viên lập");
            $table->string("IdPT", 15)->comment("Mã phiếu chỉ định phẩu thuật");
            $table->unsignedInteger("TamUng")->comment("Số tiền tạm ứng");
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
        Schema::dropIfExists('tam_ung_pt');
    }
}
