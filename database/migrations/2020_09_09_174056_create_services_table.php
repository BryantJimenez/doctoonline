<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->default('imagen.jpg');
            $table->string('banner')->default('imagen.jpg');
            $table->string('title');
            $table->text('description');
            $table->string('line');
            $table->string('icon')->default('image.jpg');
            $table->string('diary_title')->nullable();
            $table->text('diary_description')->nullable();
            $table->string('app_title')->nullable();
            $table->text('app_description')->nullable();
            $table->enum('featured', [0, 1])->default(1);
            $table->enum('type', [1, 2])->default(1);
            $table->enum('state', [0, 1])->default(1);
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
        Schema::dropIfExists('services');
    }
}
