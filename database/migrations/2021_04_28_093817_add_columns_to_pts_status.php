<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPtsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pts_status', function (Blueprint $table) {
            $table->string('state')->nullable();
            $table->string('fio_workers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pts_status', function (Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('fio_workers');

        });
    }
}
