<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number_doctor');
            $table->string('inscription');
            $table->string('signature');
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('profession_id')->unsigned()->nullable();
            $table->bigInteger('people_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('doctors');
    }
}
