<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Libros extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('autores',function($table){
			$table->increments('id')->unsigned();
			$table->string('nombres');
			$table->string('apellidos');	
			$table->timestamps();		
		});

		Schema::create('editoriales',function($table){
			$table->increments('id')->unsigned();
			$table->string('nombre');
			$table->timestamps();		
		});

		Schema::create('libros',function($table){
			$table->increments('id')->unsigned();
			$table->string('nombre');
			$table->integer('autor_id')->unsigned();
			$table->foreign('autor_id')->references('id')->on('autores');
			$table->integer('editorial_id');
			$table->integer('ubicacion_id');
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
		Schema::table('libros', function (Blueprint $table) {
            $table->dropForeign('libros_autor_id_foreign');            
        });

		Schema::drop('libros');
		Schema::drop('autores');
	}

}
