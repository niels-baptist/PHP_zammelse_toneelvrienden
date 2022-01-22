<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_id');
            $table->foreignId('reservation_id')->nullable();
            $table->foreignId('chair_id');
            $table->boolean('wheelchairAccessible');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('performance_id')->references('id')->on('performances')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('chair_id')->references('id')->on('chairs')
                ->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
