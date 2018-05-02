<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name', 64);
            $table->string('category', 200);
            $table->datetime('datetime');
            $table->string('description', 2500);
            $table->string('location', 100);
            $table->integer('organiserid')->unsigned();
            $table->string('imagepath', 500);
            $table->string('imagename', 500);
            $table->string('docpath', 500)->nullable($value = true);
            $table->integer('likeness')->nullable($value = true);
            $table->string('related', 500)->nullable($value = true);
            $table->string('weblink', 2500)->nullable($value = true);
            $table->timestamps();

            $table->foreign('organiserid')->references('id')->on('users')->onDelete('cascade');
        });

        // \DB::statement('ALTER TABLE `events` ADD `image` MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
