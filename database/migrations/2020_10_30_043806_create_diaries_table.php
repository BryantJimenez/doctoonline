<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('dni');
            $table->string('verify_digit');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('gender');
            $table->string('birthday');
            $table->string('phone');
            $table->date('date');
            $table->string('time');
            $table->float('amount', 10, 2)->default(0.00)->unsigned();
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('payment_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
