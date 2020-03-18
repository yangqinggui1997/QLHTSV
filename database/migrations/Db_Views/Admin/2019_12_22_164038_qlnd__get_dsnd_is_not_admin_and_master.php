<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class QlndGetDsndIsNotAdminAndMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS qlnd__get_dsnd_is_not_admin_and_master');
        $sql = '
        CREATE VIEW qlnd__get_dsnd_is_not_admin_and_master AS SELECT * FROM users WHERE users.`idQuyen` <> "master" AND users.`idQuyen` <> "admin" WITH CASCADED CHECK OPTION';
        DB::unprepared($sql);
    }
}
