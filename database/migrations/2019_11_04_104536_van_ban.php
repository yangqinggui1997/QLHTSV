<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VanBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Thông tin văn bản dạng file pdf*/
        Schema::create('van_ban', function (Blueprint $table) {
            $table->bigIncrements('idVB')->comment("Mã văn bản");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("tieuDe")->comment("Tiêu đề");
            $table->string("file")->comment("File liên kết");
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
        Schema::dropIfExists('van_ban');
    }
}
