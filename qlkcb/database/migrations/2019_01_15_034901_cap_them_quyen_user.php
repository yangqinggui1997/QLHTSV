<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CapThemQuyenUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap_them_quyen_user', function (Blueprint $table) {
            $table->string('IdCQ', 15)->primary()->comment("Mã cấp quyền");
            $table->unsignedInteger('IdUser')->comment("Mã người dùng");
            $table->string('Quyen')->comment("Quyền mới cấp cho user");
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
        Schema::dropIfExists('cap_them_quyen_user');
    }
}
