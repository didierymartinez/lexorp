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
		Schema::create('tipos_articulos', function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
	        $table->timestamps();
		});

		Schema::create('tipos_creacion_articulos', function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
	        $table->timestamps();
		});

		Schema::create('tipos_eliminacion_articulos', function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
	        $table->timestamps();
		});

		Schema::create('articulos',function($table){
				$table->increments('id')->unsigned();
			//Tipo articulo EJ:libro y el id en la tabla libros
				$table->integer('tipo_id')->unsigned();
				$table->integer('articulo_id')->unsigned();
			//Para saber motivo de la creación y eliminación si es dado de baja
				$table->integer('tipos_creacion_articulos_id')->unsigned();
				$table->integer('tipos_eliminacion_articulos_id')->unsigned()->nullable();	
			//Relaciones
		        $table->foreign('tipo_id')->references('id')->on('tipos_articulos');
				$table->foreign('tipos_creacion_articulos_id')->references('id')->on('tipos_creacion_articulos');
				$table->foreign('tipos_eliminacion_articulos_id')->references('id')->on('tipos_eliminacion_articulos');
				

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
            $table->dropForeign('articulos_tipos_creacion_articulos_id_foreign');            
            $table->dropForeign('articulos_tipos_eliminacion_articulos_id_foreign');            
        });


		Schema::drop('articulos');		
		Schema::drop('tipos_articulos');
		Schema::drop('tipos_creacion_articulos');
		Schema::drop('tipos_eliminacion_articulos');
	}

}
