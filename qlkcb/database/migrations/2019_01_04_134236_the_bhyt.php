<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TheBhyt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_bhyt', function (Blueprint $table) {
            $table->string('IdTheBHYT', 15)->primary()->comment("Mã thẻ bảo hiểm y tế");
            $table->string("IdCSKBHYT", 15)->comment("Mã cơ sở khám BHYT");
            $table->string("IdBN", 15)->comment("Mã bệnh nhân");
            $table->timestamp("NgayDK")->useCurrent()->comment("Ngày đăng ký");
            $table->timestamp("NgayHHDT")->useCurrent()->comment("Ngày đến hạn đóng tiền");
            $table->timestamp("NgayHH")->useCurrent()->comment("Ngày hết hạn");
            $table->string("DoiTuongBHYT", 100)->comment("Đối tượng tham gia BHYT");
            $table->unsignedTinyInteger("BHYTHoTro")->comment("Phần trăm BHYT hỗ trợ");
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
        Schema::dropIfExists('the_bhyt');
    }
}
