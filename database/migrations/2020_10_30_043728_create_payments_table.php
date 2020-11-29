<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('subject');
            $table->string('method');
            $table->string('currency');
            $table->float('amount', 10, 2)->default(0.00)->unsigned();
            $table->float('fee', 10, 2)->default(0.00)->unsigned()->nullable();
            $table->float('taxes', 10, 2)->default(0.00)->unsigned()->nullable();
            $table->float('balance', 10, 2)->default(0.00)->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
