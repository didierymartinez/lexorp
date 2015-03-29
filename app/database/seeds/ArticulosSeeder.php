<?php
	class ArticulosSeeder extends Seeder {
 
    public function run()
    {
        DB::table('autor_libro')->delete();
        DB::table('libros')->delete();        
        DB::table('autores')->delete();

        DB::table('movimientos')->delete();
        DB::table('entradas')->delete();
        DB::table('inventario')->delete();
        DB::table('articulos')->delete();

        DB::table('tipos_articulos')->delete();
        
        DB::statement('ALTER TABLE libros AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE autores AUTO_INCREMENT = 1;');
		DB::statement('ALTER TABLE articulos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE inventario AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE movimientos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE entradas AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE prestamos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE devoluciones AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_articulos AUTO_INCREMENT = 1;');
                

        DB::table('tipos_articulos')->insert(array(
        	array('Tipo' => 'Libro'),
        	array('Tipo' => 'Revista') 
        ));            
    }
 
}