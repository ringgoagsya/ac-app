<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_ac');
            $table->timestamp('tanggal_service');
            $table->time('start_time');
            $table->time('stop_time');
            $table->string('id_teknisi');
            $table->timestamps();
            $table->foreign('id_ac')->references('id_ac')->on('acs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_teknisi')->references('id_teknisi')->on('teknisis')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_services');
    }
}
