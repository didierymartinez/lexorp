<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articulos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiposarticulos', function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
	        $table->timestamps();

		});

		Schema::create('articulos',function($table){
			$table->increments('id')->unsigned();
			$table->integer('tipo_id')->unsigned();
			$table->integer('articulo_id')->unsigned();
	        $table->foreign('tipo_id')->references('id')->on('tiposarticulos');
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
		Schema::table('articulos', function (Blueprint $table) {
            $table->dropForeign('articulos_tipo_id_foreign');            
        });

		Schema::drop('articulos');
		Schema::drop('TiposArticulos');
	}

}
