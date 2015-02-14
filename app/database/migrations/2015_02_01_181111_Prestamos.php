<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Prestamos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_prestamos', function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
	        $table->timestamps();

		});

		Schema::create('Prestamos',function($table){
			$table->increments('id')->unsigned();
			$table->integer('tipoprestamo_id')->unsigned();
			$table->integer('articulo_id')->unsigned();
			$table->integer('usuario_id')->unsigned();
	        $table->foreign('tipoprestamo_id')->references('id')->on('tipos_prestamos');
	        $table->foreign('articulo_id')->references('id')->on('articulos');
	        $table->foreign('usuario_id')->references('id')->on('users');
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
		Schema::table('prestamos', function (Blueprint $table) {
            $table->dropForeign('prestamos_tipoprestamo_id_foreign');
            $table->dropForeign('prestamos_articulo_id_foreign');
            $table->dropForeign('prestamos_usuario_id_foreign');            
        });

		Schema::drop('prestamos');
		Schema::drop('tipos_prestamos');
	}
}