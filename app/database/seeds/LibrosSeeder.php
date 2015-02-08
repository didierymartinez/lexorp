<?php
	class LibrosSeeder extends Seeder {
 
    public function run()
    {
       
        DB::table('libros')->delete();
        DB::table('autores')->delete();
        
        $autor1 = Autor::create(array(
            'nombres' => 'Garcia',
            'apellidos' => 'Marquez'
        ));


        $Libro1 = Libro::create(array(
                'nombre' => 'Cien años de soledad',
                'autor_id' => $autor1->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));
                  
    }
 
}