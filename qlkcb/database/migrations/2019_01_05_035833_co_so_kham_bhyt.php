<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoSoKhamBhyt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_so_kham_bhyt', function (Blueprint $table) {
            $table->string('IdCSKBHYT', 15)->primary() ->comment("Mã cơ sở khám BHYT");
            $table->text("TenCS")->comment("Tên cơ sở khám BHYT");
            $table->unsignedTinyInteger("Tuyen")->comment("Cơ sở thuộc tuyến nào?");
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
        Schema::dropIfExists('co_so_kham_bhyt');
    }
}
