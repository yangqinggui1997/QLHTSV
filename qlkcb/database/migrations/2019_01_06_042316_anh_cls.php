<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnhCls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anh_cls', function (Blueprint $table) {
            $table->string('IdACLS', 15)->primary()->comment("Mã ảnh kết quả cận lâm sàng");
            $table->string("IdKQCLS", 15)->comment("Mã kết quả cận lâm sàng");
            $table->string("Anh")->comment("Ảnh cận lâm sàng");  
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
        Schema::dropIfExists('anh_cls');
    }
}
