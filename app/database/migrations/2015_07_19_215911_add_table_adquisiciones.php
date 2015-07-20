<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableAdquisiciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adquisiciones',function($table){
			$table->increments('id')->unsigned();
			$table->date('Fecha');
			$table->string("Tipo",50);
			$table->integer("Cantidad");
			$table->string("Proveedor",200);
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
		//
	}

}
