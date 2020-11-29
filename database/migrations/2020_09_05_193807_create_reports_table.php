<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->text('reason');
            $table->enum('select_personal_history', ["No", "Si"])->default("No");
            $table->text('personal_history')->nullable();
            $table->enum('select_surgical_history', ["No", "Si"])->default("No");
            $table->text('surgical_history')->nullable();
            $table->enum('select_family_history', ["No", "Si"])->default("No");
            $table->text('family_history')->nullable();
            $table->text('medicines')->nullable();
            $table->text('foods')->nullable();
            $table->text('others_allergies')->nullable();
            $table->enum('tobacco', ["No", "Si"])->default("No");
            $table->integer('number_cigarettes')->default(0)->unsigned()->nullable();;
            $table->string('years_smoker')->nullable();
            $table->enum('alcohol', ["No", "Si"])->default("No");
            $table->integer('number_liters')->default(0)->unsigned()->nullable();;
            $table->string('years_taker')->nullable();
            $table->enum('drugs', ["No", "Si"])->default("No");
            $table->string('years_consumption')->nullable();
            $table->text('indicate_drugs')->nullable();
            $table->text('disease_current')->nullable();
            $table->float('weight', 5, 1)->default(0.0)->unsigned();
            $table->float('height', 5, 2)->default(0.00)->unsigned();
            $table->float('temperature', 5, 1)->default(0.0)->unsigned();
            $table->integer('pulse')->default(0)->unsigned();
            $table->float('systolic_pressure', 10, 1)->default(0.0)->unsigned();
            $table->float('dystolic_pressure', 10, 1)->default(0.0)->unsigned();
            $table->float('frequency', 10, 1)->default(0.0)->unsigned();
            $table->text('mucous')->nullable();
            $table->text('head_neck')->nullable();
            $table->text('respiratory')->nullable();
            $table->text('cardiovascular')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('others_exams')->nullable();
            $table->text('order')->nullable();
            $table->text('recipe')->nullable();
            $table->text('report')->nullable();
            $table->enum('phase', [0, 1, 2, 3, 4, 5, 6])->default(1);
            $table->enum('state', [1, 2])->default(2);
            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reports');
    }
}
