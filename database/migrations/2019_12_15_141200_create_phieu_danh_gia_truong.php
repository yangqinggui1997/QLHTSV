<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuDanhGiaTruong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_danh_gia_truong', function (Blueprint $table) {
            $table->string("idHKSV", 5)->comment("Mã học kỳ học tập của sinh viên");
            $table->string("idUser", 15)->primary()->comment("Mã người dùng");
            $table->string("idTCDGT", 15)->comment("Mã tiêu chí đánh giá trường");
            $table->unsignedTinyInteger("diem")->comment("Điểm số");
            $table->text("kienNghi")->comment("Kiến nghị");
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
        Schema::dropIfExists('phieu_danh_gia_truong');
    }
}
