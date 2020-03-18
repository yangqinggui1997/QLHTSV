<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment("Mã người dùng");
            $table->string('IdNV', 15)->comment("Mã nhân viên");
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('Quyen')->comment("Quyền người dùng");
            $table->string('TrangThai')->comment("Trang thái người dùng");
            $table->unsignedTinyInteger('SLDN')->comment("Số lần đăng nhập trên các trình duyệt khác nhau");
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
