<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id');
            $table->foreignId('play_id');
            $table->dateTime('dateTime');
            $table->boolean('active');
            $table->float('price', 5,2);
            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->onUpdate('cascade');
            $table->foreign('play_id')->references('id')->on('plays')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performances');
    }
}
