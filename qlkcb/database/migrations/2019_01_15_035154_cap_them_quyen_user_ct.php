<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CapThemQuyenUserCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap_them_quyen_user_ct', function (Blueprint $table) {
            $table->string('IdCQCT', 15)->primary()->comment("Mã cấp quyền chi tiết");
            $table->string('IdCQ', 15)->comment("Mã người dùng");
            $table->string('QuyenCT')->comment("Quyền chi tiết cho từng danh mục quyền mới cấp cho user");
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
        Schema::dropIfExists('cap_them_quyen_user_ct');
    }
}
