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
			$table->string('titulo');
			$table->string('subtitulo');
			$table->string('titulooriginal');
			$table->integer('anoedicion');
			$table->string('edicion');
			$table->string('isbn');
			$table->string('coleccion');
			$table->integer('editorial_id')->unsigned();
			$table->foreign('editorial_id')->references('id')->on('editoriales');
			$table->timestamps();
		});


		Schema::create('autor_libro', function($table){
			$table->integer('autor_id')->unsigned();
			$table->foreign('autor_id')->references('id')->on('autores');
			$table->integer('libro_id')->unsigned();
			$table->foreign('libro_id')->references('id')->on('libros');
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
            $table->dropForeign('libros_editorial_id_foreign');            
        });

		Schema::table('autor_libro', function (Blueprint $table) {
            $table->dropForeign('autor_libro_autor_id_foreign');            
            $table->dropForeign('autor_libro_libro_id_foreign');            
        });

		Schema::drop('autor_libro');
		Schema::drop('libros');
		Schema::drop('autores');
		Schema::drop('editoriales');
	}

}
