<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetTruongBm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS qlk_bm__get_truong_bm');
        $sql = '
        CREATE PROCEDURE qlk_bm__get_truong_bm(idPhong VARCHAR(255)) SELECT cb.* FROM phong_ban AS pb JOIN can_bo_giang_vien AS cb ON pb.`idPhong` = cb.`idPhong` WHERE pb.`idPhong` = idPhong AND (cb.`chucVu` = "truong_phong" OR cb.`chucVu` = "truong_bo_mon") LIMIT 1';
        DB::unprepared($sql);
    }
}
