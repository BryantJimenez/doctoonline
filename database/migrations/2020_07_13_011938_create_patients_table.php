<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('civil_state', ["Soltero", "Casado"])->nullable();
            $table->integer('children')->nullable();
            $table->enum('laboral', ["Empleado", "Cesante", "Jubilado"])->nullable();
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('study_id')->unsigned()->nullable();
            $table->bigInteger('insurer_id')->unsigned()->nullable();
            $table->bigInteger('people_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
