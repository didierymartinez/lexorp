<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tipos_tags', function($table){
            $table->increments('id')->unsigned();
            $table->string('Tipo')->unique();
        });


        Schema::create('tags',function($table){
            $table->increments('id')->unsigned();
            $table->string('epc');
            $table->unique('epc');
            $table->integer('objeto_id')->unsigned()->nullable();
            $table->string('objeto_type')->nullable();
            $table->foreign('objeto_type')->references('Tipo')->on('tipos_tags');
            $table->timestamps();
        });

        Schema::table('usuariosbiblioteca', function($table)
        {
            $table->integer('tag_id')->unsigned()->nullable();
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('inventario', function($table)
        {
            $table->integer('tag_id')->unsigned()->nullable();
            $table->foreign('tag_id')->references('id')->on('tags');
        });


    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_objeto_type_foreign');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropUnique('tags_epc_unique');
        });

        Schema::drop('tags');
        Schema::drop('tipos_tags');
	}

}
