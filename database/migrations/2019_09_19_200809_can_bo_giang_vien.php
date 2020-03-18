<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CanBoGiangVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin cán bộ, giảng viên*/
        Schema::create('can_bo_giang_vien', function(Blueprint $table){
            $table->string('idCB', 15)->primary()->comment("Mã cán bộ, giảng viên");
            $table->string('idXa', 15)->comment("Mã xã (phường)");
            $table->string("idPhong")->comment("Mã phòng ban hoặc bộ môn");
            $table->string("hoTen")->comment("Họ tên cán bộ, giảng viên");
            $table->boolean("gioiTinh")->unsigned()->comment("Giới tính");
            $table->string("SDT", 15)->comment("Số điện thoại");
            $table->string('email')->unique()->comment("Địa chỉ email");
            $table->string("hocVi", 50)->comment("Học vị");
            $table->string("chuyenMon", 100)->comment("Chuyên môn");
            $table->string("nghiepVu")->comment("Nghiệp vụ");
            $table->string("chucVu")->comment("Chức vụ");
            $table->string("anh")->nullable()->comment("Ảnh cán bộ, giảng viên");
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
        Schema::dropIfExists("can_bo_giang_vien");
    }
}
