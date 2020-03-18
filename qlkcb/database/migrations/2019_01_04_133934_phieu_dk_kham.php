<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhieuDkKham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_dk_kham', function (Blueprint $table) {
            $table->string('IdPhieuDKKB', 15)->primary()->comment("Mã phiếu đăng ký khám bệnh");
            $table->string("IdNV", 15)->comment("Mã nhân viên lập phiếu");
            $table->string("IdBN", 15)->comment("Mã bệnh nhân");
            $table->string("IdPK", 15)->comment("Mã phòng khám");
            $table->boolean("KhamBHYT")->unsigned()->comment("Đối tượng đến khám (có BHYT hay không?");
            $table->unsignedTinyInteger("TuyenKham")->comment("Khám đúng tuyến hoặc vượt tuyến");
            $table->boolean("GiayChuyen")->unsigned()->comment("Nếu bệnh nhân vượt tuyến thì xác định có giấy chuyển hay không?");
            $table->boolean("DTTN")->unsigned()->comment("Đối tượng tiếp nhận (thường hay cấp cứu?)");
            $table->unsignedSmallInteger("STT")->comment("Số thứ tự khám");
            $table->boolean("TrangThai")->unsigned()->comment("Trạng thái tiếp nhận khám từ bác sĩ của phòng khám");
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
        Schema::dropIfExists('phieu_dk_kham');
    }
}
