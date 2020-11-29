<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('day', [0, 1, 2, 3, 4, 5, 6]);
            $table->string('start');
            $table->string('end');
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('doctor_id')->references('id')->on('diary_doctor')->onDelete('cascade')->onUpdate('set null');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_schedule');
    }
}
