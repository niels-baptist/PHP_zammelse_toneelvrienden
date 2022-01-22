<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('subject')->unique();
            $table->boolean('adaptable');
            $table->timestamps();
        });
        DB::table('mails')->insert(
            [
                [
                    'content' => 'AAAAAAAAAAA',
                    'subject' => 'nogmaals aa',
                    'adaptable' => true
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
        Schema::dropIfExists('mails');
    }
}
