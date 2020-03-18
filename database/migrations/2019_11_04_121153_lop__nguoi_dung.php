<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LopNguoiDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Cho biết sinh viên dự lớp và giảng viêm làm cố vấn học tập cho lớp nào*/
        Schema::create('lop__nguoi_dung', function (Blueprint $table) {
            $table->string("idLop", 15)->primary()->comment("Mã lớp");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->boolean("VBC")->unsigned()->comment("Văn bằng chính hoặc văn bằng 2");
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
        Schema::dropIfExists('lop__nguoi_dung');
    }
}
