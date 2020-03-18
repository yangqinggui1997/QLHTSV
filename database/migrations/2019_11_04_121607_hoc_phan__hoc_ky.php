<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HocPhanHocKy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Học phần nằm trong chương trình đào tạo theo từng hoc kỳ*/
        Schema::create('hoc_phan__hoc_ky', function (Blueprint $table) {   
            $table->string("idHKDT", 5)->primary()->comment("Mã chương trình đào tạo theo học kỳ");
            $table->string("idCTDT", 300)->comment("Mã chương trình đào tạo");
            $table->string("idHP", 15)->comment("Mã học phần");
            $table->string("loaiHP", 100)->comment("Học phần bắt buộc, tự chọn hay điều kiện");
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
        Schema::dropIfExists('hoc_phan__hoc_ky');
    }
}
