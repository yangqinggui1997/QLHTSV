<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BieuMauDangFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Biểu mẫu dạng file*/
        Schema::create('bieu_mau_dang_file', function (Blueprint $table) {             
            $table->bigIncrements('idBM')->comment("Mã biểu mẫu");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("tieuDe")->comment("Tiêu đề");
            $table->string("file")->comment("file");
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
        Schema::dropIfExists('bieu_mau_dang_file');
    }
}
