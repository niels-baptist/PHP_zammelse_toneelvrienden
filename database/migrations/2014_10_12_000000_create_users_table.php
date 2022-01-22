<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telephone');
            $table->string('firstName');
            $table->string('surname');
            $table->string('address');
            $table->string('place');
            $table->string('postalCode');
            $table->char('sex', 1); //sex bestaat uit 1 teken
            $table->boolean('active')->default(true);
            $table->boolean('admin')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [

                    'email' => 'admin@test.com',
                    'firstName' => 'admin',
                    'surname' => 'admin',
                    'telephone' => '04123123',
                    'address' => 'straat 123',
                    'place' => 'Antwerpen',
                    'postalCode' => '2000',
                    'sex' => 'M',
                    'password' => Hash::make('admin'),
                    'admin' => true,
                    'email_verified_at' => now(),
                    'created_at' => now()
                ],
                [
                    'email' => 'users@test.com',
                    'firstName' => 'test',
                    'surname' => 'test',
                    'telephone' => '04123123',
                    'address' => 'straat 123',
                    'place' => 'Antwerpen',
                    'postalCode' => '2000',
                    'sex' => 'M',
                    'password' => Hash::make('users'),
                    'admin' => false,
                    'email_verified_at' => now(),
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
        Schema::dropIfExists('users');
    }
}
