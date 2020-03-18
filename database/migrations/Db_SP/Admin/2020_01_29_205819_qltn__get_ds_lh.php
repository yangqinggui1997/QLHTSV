<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QltnGetDsLh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS qltn__get_ds_lh');
        $sql = '
        CREATE PROCEDURE qltn__get_ds_lh(idNG VARCHAR(15)) 
        SELECT DISTINCT tn.`maNN` FROM (
            SELECT * FROM (
                SELECT * FROM (
                    SELECT * FROM (
                        SELECT DISTINCT tn.`idUserNhan` AS maNN, cb.`hoTen` FROM tin_nhan AS tn JOIN users AS us ON tn.`idUserNhan` = us.`idUser` JOIN can_bo_giang_vien__nguoi_dung AS cbnd ON us.`idUser` = cbnd.`idUser` JOIN can_bo_giang_vien AS cb ON cbnd.`idUser` = cb.`idCB` WHERE tn.`idUserGui` = idNG ORDER BY cb.`hoTen` ASC 
                    ) AS TN1 
                    UNION ALL 
                    SELECT * FROM (
                        SELECT DISTINCT tn.`idUserNhan` AS maNN, sv.`hoTen` FROM tin_nhan AS tn JOIN users AS us ON tn.`idUserNhan` = us.`idUser` JOIN sinh_vien__nguoi_dung AS svnd ON us.`idUser` = svnd.`idUser` JOIN sinh_vien AS sv ON svnd.`idUser` = sv.`idSV` WHERE tn.`idUserGui` = idNG ORDER BY sv.`hoTen` ASC 
                    ) AS TN2
                ) AS tn1 ORDER BY tn1.`hoTen` ASC
            ) AS tn1
            UNION ALL 
            SELECT * FROM (
                SELECT * FROM (
                    SELECT * FROM (
                        SELECT DISTINCT tn.`idUserGui` AS maNN, cb.`hoTen` FROM tin_nhan AS tn JOIN users AS us ON tn.`idUserGui` = us.`idUser` JOIN can_bo_giang_vien__nguoi_dung AS cbnd ON us.`idUser` = cbnd.`idUser` JOIN can_bo_giang_vien AS cb ON cbnd.`idUser` = cb.`idCB` WHERE tn.`idUserNhan` = idNG ORDER BY cb.`hoTen` ASC
                    ) AS TN1 
                    UNION ALL 
                    SELECT * FROM (
                        SELECT DISTINCT tn.`idUserGui` AS maNN, sv.`hoTen` FROM tin_nhan AS tn JOIN users AS us ON tn.`idUserGui` = us.`idUser` JOIN sinh_vien__nguoi_dung AS svnd ON us.`idUser` = svnd.`idUser` JOIN sinh_vien AS sv ON svnd.`idUser` = sv.`idSV` WHERE tn.`idUserNhan` = idNG ORDER BY sv.`hoTen` ASC 
                    ) AS TN2
                ) AS tn2 ORDER BY tn2.`hoTen` ASC
            ) AS tn2
        ) AS tn ORDER BY tn.`hoTen` ASC';
        DB::unprepared($sql);
    }
}
