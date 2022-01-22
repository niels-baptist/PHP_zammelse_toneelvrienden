<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('job')->nullable();
            $table->timestamps();
        });

        DB::table('jobs')->insert(
            [
                [
                    'name' => 'Cameraman',
                    'job' => 'Neemt het toneelstuk op en voorziet cameras.',
                    'created_at' => now()
                ],
                [
                    'name' => 'Acteur',
                    'job' => 'Speelt mee in het toneelstuk.',
                    'created_at' => now()
                ],
                [
                    'name' => 'Kassier',
                    'job' => 'Neemt de aanwezigheden op en controleert of ze betaald hebben.',
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
        Schema::dropIfExists('jobs');
    }
}
