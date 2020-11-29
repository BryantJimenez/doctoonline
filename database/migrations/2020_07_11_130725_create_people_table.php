<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni');
            $table->string('verify_digit');
            $table->string('name');
            $table->string('first_lastname');
            $table->string('second_lastname');
            $table->string('photo')->default('usuario.png');
            $table->string('slug')->unique();
            $table->enum('gender', ["Masculino", "Femenino"]);
            $table->string('phone')->nullable();
            $table->string('celular')->nullable();
            $table->string('birthday');
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('type', [1, 2])->default(2);
            $table->bigInteger('commune_id')->unsigned()->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
