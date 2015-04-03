<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableUsuariosbiblioteca extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_identificacion',function($table){
			$table->increments('id')->unsigned();
			$table->string('Tipo')->unique();
			$table->string('Descripcion')->unique();
		});	

		
        Schema::create('usuariosbiblioteca', function($table) {
	        $table->increments('id');
	        $table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
	        $table->string('identificacion', 20);	        
	        $table->unique('identificacion');
	        $table->string('tipoidentificacion', 20);
	        $table->string('nombres', 50);
	        $table->string('apellidos', 50);
	        $table->string('sexo', 4);
	        $table->date("fecha_nacimiento");
	        $table->string("direccion",100);
			$table->string("tel_fijo",50);
			$table->string("celular",50);
	        $table->string('email', 100);
	        $table->boolean('activo')->default(true);
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
		Schema::table('usuariosbiblioteca', function (Blueprint $table) {
            $table->dropUnique('usuariosbiblioteca_identificacion_unique');            
        });

		Schema::drop('usuariosbiblioteca');		

	}

}
