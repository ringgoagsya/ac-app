<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acs', function (Blueprint $table) {
            $table->string('id_ac')->primary();
            $table->string('id_lokasi');
            $table->string('id_area');
            $table->integer('status');
            $table->string('type_lokasi');
            $table->integer('alarm_service')->default(90);
            $table->timestamps();
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_area')->references('id_area')->on('areas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acs');
    }
}
