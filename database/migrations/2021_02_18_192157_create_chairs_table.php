<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id');
            $table->bigInteger('floor');
            $table->bigInteger('chairNumber');
            $table->boolean('active');

            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade')->onUpdate('cascade');
        });


        for ($i = 1; $i <= 205; $i++) {
            if ($i <= 52){
                $floor = 0;
            }elseif ($i <= 91){
                $floor = 1;
            }elseif ($i <= 130){
                $floor = 2;
            }elseif ($i <= 169){
                $floor = 3;
            }else{
                $floor = 4;
            }

            DB::table('chairs')->insert(
                [
                    'hall_id' => 1,
                    'floor' => $floor,
                    'chairNumber' => $i,
                    'active' => !($i == 180 || $i == 193),
                    'created_at' => now()
                ]
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chairs');
    }
}
