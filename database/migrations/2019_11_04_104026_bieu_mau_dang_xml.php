<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BieuMauDangXml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Biểu mẫu dạng hoặc xml*/
        Schema::create('bieu_mau_dang_xml', function (Blueprint $table) {             
            $table->bigIncrements('idBM')->comment("Mã biểu mẫu");
            $table->string("idUser", 15)->comment("Mã người dùng");
            $table->string("tieuDe")->comment("Tiêu đề");
            $table->mediumText("noiDung")->comment("Nội dung");
            $table->mediumText("JS")->comment("Java script cho biểu mẫu hoạt động");
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
        Schema::dropIfExists('bieu_mau_dang_xml');
    }
}
