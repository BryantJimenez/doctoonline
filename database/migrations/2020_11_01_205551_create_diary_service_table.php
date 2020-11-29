<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price', 10, 2)->default(0.00)->unsigned();
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->bigInteger('diary_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_service');
    }
}
