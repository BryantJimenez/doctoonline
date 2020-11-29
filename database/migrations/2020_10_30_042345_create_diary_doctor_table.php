<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_doctor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->enum('rating', [1, 2, 3, 4, 5])->default(1);
            $table->string('url')->nullable();
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_doctor');
    }
}
