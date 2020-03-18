<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileCuaTinNhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_cua_tin_nhan', function (Blueprint $table){
            $table->bigIncrements('idFile')->comment("Mã file của tin nhắn");
            $table->unsignedBigInteger('idTN')->comment("Mã tin nhắn");
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
        Schema::dropIfExists('file_cua_tin_nhan');
    }
}
