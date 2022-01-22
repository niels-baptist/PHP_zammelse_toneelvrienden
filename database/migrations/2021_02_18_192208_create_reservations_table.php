<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_id');
            $table->dateTime('reservationDate');
            $table->boolean('paymentByTransfer');
            $table->boolean('paid');
            $table->string('email');
            $table->string('firstName');
            $table->string('surname');
            $table->string('telephone');
            $table->string('address');
            $table->string('place');
            $table->string('postalCode');
            $table->timestamps();

            $table->foreign('performance_id')->references('id')->on('performances')
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
        Schema::dropIfExists('reservations');
    }
}
