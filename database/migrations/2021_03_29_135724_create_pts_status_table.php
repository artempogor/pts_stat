<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtsStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pts_status', function (Blueprint $table) {
            $table->id()->nullable();
            $table->foreignId('pts_id')->nullable()->constrained('pts')->onDelete('cascade');
            $table->text('serial_pts')->nullable();
            $table->string('ip')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('checked_up')->nullable();
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
        Schema::dropIfExists('pts_status');
    }
}
