<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('tipos_estado_inventario',function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
		});	

		Schema::create('tipos_movimientos',function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
		});	


		Schema::create('inventario',function($table){
			$table->increments('id')->unsigned();
			$table->string('placa');
			$table->integer('articulo_id')->unsigned();
			$table->foreign('articulo_id')->references('id')->on('articulos');

			$table->integer('estado_id')->unsigned();
			$table->foreign('estado_id')->references('id')->on('tipos_estado_inventario');
			
			$table->integer('ultimoMovimiento_id')->unsigned();
			$table->timestamps();
		});	




		Schema::create('movimientos',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->integer('movimiento_id')->unsigned();
			$table->string('movimiento_type');
			$table->foreign('movimiento_type')->references('Tipo')->on('tipos_movimientos');
			$table->timestamps();
		});	

		Schema::create('entradas',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	

		Schema::create('prestamos',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->integer('usuario_id')->unsigned();
			$table->date('fechadevolucion');			
	        $table->foreign('inventario_id')->references('id')->on('inventario');
	        $table->foreign('usuario_id')->references('id')->on('users');
			$table->timestamps();
		});

		Schema::create('devoluciones',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	


/*
		Schema::create('salidas',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	

		Schema::create('devoluciones',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	

		Schema::create('reservas',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	

		Schema::create('traslados',function($table){
			$table->increments('id')->unsigned();
			$table->integer('inventario_id')->unsigned();
			$table->foreign('inventario_id')->references('id')->on('inventario');
			$table->timestamps();
		});	
*/		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('prestamos', function (Blueprint $table) {
            $table->dropForeign('prestamos_inventario_id_foreign');
            $table->dropForeign('prestamos_usuario_id_foreign');            
        });

		Schema::drop('prestamos');
	}

}
