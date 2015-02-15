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
		});


		Schema::create('articulos',function($table){
				$table->increments('id')->unsigned();
				$table->integer('articulo_id')->unsigned();
				$table->string('articulo_type');			
		        $table->foreign('articulo_type')->references('Tipo')->on('tipos_articulos');
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
            $table->dropForeign('articulos_articulo_type_foreign');                    
        });


		Schema::drop('articulos');		
		Schema::drop('tipos_articulos');
	}

}
