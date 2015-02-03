<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
	        $table->increments('id');
	        $table->string('identificacion', 20);	        
	        $table->unique('identificacion');
	        $table->string('email', 100);
	        $table->string('password', 64);
	        $table->string('first_name', 20);
	        $table->string('last_name', 20);
	        $table->boolean('sys')->default(false);
	        $table->rememberToken();
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
		Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_identificacion_unique');            
        });

		Schema::drop('users');
	}


}