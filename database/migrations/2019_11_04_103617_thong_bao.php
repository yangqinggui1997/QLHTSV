<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThongBao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Thông báo của người dùng*/
        Schema::create('thong_bao', function (Blueprint $table) {
            $table->bigIncrements('idTB')->comment("Mã thông báo");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("tieuDe")->comment("Tiêu đề");
            $table->mediumText("noiDung")->comment("Nội dung");
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
        Schema::dropIfExists('thong_bao');
    }
}
