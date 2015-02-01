<?php
	class TiposArticulosSeeder extends Seeder {
 
    public function run()
    {
        DB::table('TiposArticulos')->delete();
        
        $libro = TipoArticulos::create(array(
                'Tipo' => 'Libro' 
        ));                   
    }
 
}