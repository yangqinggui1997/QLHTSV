<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlPhanHoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ql_phan_hoi', function (Blueprint $table) {
            $table->string('IdPH', 15)->comment("Mã phản hồi");
            $table->unsignedInteger('IdUser')->comment("Mã người dùng");
            $table->mediumText('NoiDung')->comment("Nội dung phản hồi");
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
        Schema::dropIfExists('ql_phan_hoi');
    }
}
