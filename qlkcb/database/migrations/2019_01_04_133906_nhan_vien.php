<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NhanVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->string('IdNV', 15)->primary()->comment("Mã nhân viên");
            $table->string("IdPB", 15)->comment("Mã phòng ban");
            $table->string('IdXa', 15)->comment("Mã xã phường");
            $table->text("TenNV")->comment("Tên nhân viên");
            $table->timestamp("NgaySinh")->useCurrent()->comment("Ngày sinh");
            $table->boolean("GioiTinh")->unsigned()->comment("Giới tính");
            $table->string("DanToc")->comment("Dân tộc");
            $table->string("SoCMND", 9)->comment("Số chứng minh nhân dân hoặc passport");
            $table->string("SDT", 10)->comment("Số điện thoại");
            $table->string("STK", 13)->comment("Số tài khoản ngân hàng");
            $table->string("Email")->comment("Email");
            $table->mediumText("DiaChi")->nullable()->comment("Địa chỉ (số nhà hoặc tên đường)");
            $table->text("ChuyenMon")->comment("Chuyên môn nghiệp vụ");
            $table->string("TrinhDo")->comment("Trình độ");
            $table->string("CV")->comment("Công việc");
            $table->timestamp("HopDongTuNgay")->useCurrent()->comment("Hợp đồng từ ngày");
            $table->timestamp("HopDongDenNgay")->useCurrent()->comment("Hợp đồng đến ngày");
            $table->unsignedTinyInteger("BL", 2)->comment("Bậc lương");
            $table->boolean("LoaiNV")->unsigned()->comment("Nhân viên biên chế hay hợp đồng?");
            $table->mediumText("Anh")->nullable()->comment("Ảnh nhân viên");
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
        Schema::dropIfExists('nhan_vien');
    }
}
