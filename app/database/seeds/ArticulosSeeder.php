<?php
	class ArticulosSeeder extends Seeder {
 
    public function run()
    {
        DB::table('libros')->delete();
        DB::table('autores')->delete();
        DB::table('articulos')->delete();

        DB::table('tipos_articulos')->delete();
        
        DB::statement('ALTER TABLE libros AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE autores AUTO_INCREMENT = 1;');
		DB::statement('ALTER TABLE articulos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_articulos AUTO_INCREMENT = 1;');
        

        DB::table('tipos_articulos')->insert(array(
        	array('Tipo' => 'Libro'),
        	array('Tipo' => 'Revista') 
        ));            
    }
 
}