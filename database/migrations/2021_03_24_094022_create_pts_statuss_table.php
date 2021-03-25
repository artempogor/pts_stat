<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtsStatussTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            Schema::create('pts_status', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('serial_pts');
                $table->string('city')->default('Донецк');
                $table->string('address')->default('Ул.Советская');
                $table->ipAddress('ip')->default('127.0.0.1');
                $table->decimal('latitude',8,6)->default(1.0)->nullable();
                $table->decimal('longitude',9,6)->default(1.0)->nullable();
                $table->string('info')->nullable();;
                $table->timestamps();
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
        Schema::dropIfExists('pts_status');
    }
}
