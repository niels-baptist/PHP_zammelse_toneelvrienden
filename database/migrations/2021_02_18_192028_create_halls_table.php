<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('capacity');
            $table->string('address');
            $table->string('place');
            $table->string('postalCode');
            $table->timestamps();
        });

        DB::table('halls')->insert(
            [

                [
                    'name' => 'Parochiezaal Geel',
                    'capacity' => '205',
                    'address' => 'Zammelseweg 201',
                    'place' => 'Geel',
                    'postalCode' => '2440',
                    'created_at' => now()
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
}
