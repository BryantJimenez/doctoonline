<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->bigInteger('specialty_id')->unsigned()->nullable();
            $table->bigInteger('people_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('service_id')->references('id')->on('diary_service')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_service');
    }
}
