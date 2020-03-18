<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhMucThuoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc_thuoc', function (Blueprint $table) {
            $table->string('IdThuoc', 15)->primary()->comment("Mã danh mục thuốc");
            $table->text("TenThuoc")->comment("Tên danh mục thuốc");
            $table->text("TenKDau")->comment("Tên gọ không dấu của danh mục thuốc");
            $table->text("NSX")->comment("Nhà sản xuất");
            $table->text("NCU")->comment("Nhà cung ứng");
            $table->timestamp("NgaySX")->useCurrent()->comment("Ngày sản xuất");
            $table->timestamp("NgayHH")->useCurrent()->comment("Ngày hết hạn sử dụng");
            $table->unsignedBigInteger("SL")->comment("Số lượng");
            $table->string("DonViTinh")->comment("Đơn vị tính");
            $table->unsignedInteger("DonGiaNhap")->comment("Đơn giá nhập"); 
            $table->unsignedInteger('DonGiaBan')->comment("Đơn giá bán");
            $table->mediumText("ChongChiDinh")->comment("Chống chỉ đinh");
            $table->mediumText('ThanhPhan')->comment("Thành phần thuốc");
            $table->string("PhanLoai")->comment("Phân loại thuốc (thuốc dùng để uống, tiêm, truyền dịch, ...)");
            $table->boolean("DanhMucBHYT")->unsigned()->comment("Có thuộc danh mục BHYT hay ko?");
            $table->unsignedTinyInteger("BHYTTT")->comment("Phần trăm BHYT thanh toán");
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
        Schema::dropIfExists('danh_muc_thuoc');
    }
}
