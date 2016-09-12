<?php
	class ArticulosSeeder extends Seeder {
 
    public function run()
    {

        DB::table('tipos_articulos')->insert(array(
        	array('Tipo' => 'Libro'),
        	array('Tipo' => 'Revista') 
        ));            
    }
 
}