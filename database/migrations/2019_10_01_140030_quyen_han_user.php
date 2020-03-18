<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuyenHanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin các quyền hạn có tronng hệ thống*/
        Schema::create('quyen_han_user', function (Blueprint $table) {
            $table->string('idQuyen',30)->primary()->comment("Mã quyền hạn");
            $table->string('tenQH')->comment("Tên quyền hạn");
            $table->string('moTa')->nullable()->comment("Mô tả");
            $table->unsignedTinyInteger('capDo')->comment("Cấp độ quyền");
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
        Schema::dropIfExists('quyen_han_user');
    }
}
