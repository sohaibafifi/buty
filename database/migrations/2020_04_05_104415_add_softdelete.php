<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftdelete extends Migration
{
    protected $tables = ['departments', 'formations', 'semestres', 'groups', 'users'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table_name) {
            if (!Schema::hasColumn($table_name, 'deleted_at'))
                Schema::table($table_name, function (Blueprint $table) {
                    $table->softDeletes();
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table_name) {
            if (Schema::hasColumn($table_name, 'deleted_at'))
                Schema::table($table_name, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
        }
    }
}
