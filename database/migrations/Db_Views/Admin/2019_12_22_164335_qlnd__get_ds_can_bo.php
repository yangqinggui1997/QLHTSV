<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class QlndGetDsCanBo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS qlnd__get_ds_can_bo');
        $sql = '
        CREATE VIEW qlnd__get_ds_can_bo AS SELECT * FROM can_bo_giang_vien WHERE !(can_bo_giang_vien.`idCB` IN (SELECT can_bo_giang_vien__nguoi_dung.`idUser` FROM can_bo_giang_vien__nguoi_dung)) WITH CASCADED CHECK OPTION';
        DB::unprepared($sql);
    }
}
