<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Chứa thông tin người dùng hệ thống*/
        Schema::create('users', function (Blueprint $table) {
            $table->string('idUser', 15)->primary()->comment("Mã người dùng");
            $table->string('idQuyen', 30)->comment("Mã quyền hạn");
            $table->string('email')->unique()->comment("Địa chỉ email");
            $table->string('password')->comment("Mật khẩu");
            $table->string('thaoTac', 30)->comment("Quyền thao tác trên đối tượng");
            $table->unsignedBigInteger('soLanDangNhap')->comment("Số lần người dùng đăng nhập vào hệ thống");
            $table->datetime("dangNhapLC")->useCurrent()->comment('Đăng nhập lần cuối');
            $table->string("trangThai")->comment('Trạng thái người dùng');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
