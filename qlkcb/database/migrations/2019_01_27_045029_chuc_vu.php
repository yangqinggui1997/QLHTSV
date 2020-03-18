<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChucVu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuc_vu', function (Blueprint $table) {
            $table->string('IdCV')->primary()->comment("Mã chức vụ");
            $table->string("TenCV")->comment("Tên chức vụ (vd: Giám đốc, Trưởng khoa, ...)");
            $table->float("HSPCCV",6,4)->unsigned()->comment("Hệ số phụ cấp chức vụ");
            $table->unsignedTinyInteger("CB", 2)->comment("Cấp bậc chức vụ");
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
        Schema::dropIfExists('chuc_vu');
    }
}
