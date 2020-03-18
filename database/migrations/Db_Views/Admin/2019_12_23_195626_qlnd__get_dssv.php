<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class QlndGetDssv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS qlnd__get_dssv');
        $sql = '
        CREATE VIEW qlnd__get_dssv AS SELECT * FROM sinh_vien WHERE !(sinh_vien.`idSV` IN (SELECT sinh_vien__nguoi_dung.`idUser` FROM sinh_vien__nguoi_dung)) WITH CASCADED CHECK OPTION';
        DB::unprepared($sql);
    }
}
