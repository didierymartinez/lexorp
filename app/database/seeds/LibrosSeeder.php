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

        $autor2 = Autor::create(array(
            'nombres' => 'Thomas',
            'apellidos' => 'Piketty'
        ));
  

        $Libro1 = Libro::create(array(
                'nombre' => 'Cien años de soledad',
                'autor_id' => $autor1->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));

         $Libro2 = Libro::create(array(
                'nombre' => 'El capital en el siglo XXI',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));
           
         $Libro3 = Libro::create(array(
                'nombre' => 'The Baffler No. 25',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));


         $Libro2 = Libro::create(array(
                'nombre' => 'Top Incomes: A Global Perspective',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));

         $Libro2 = Libro::create(array(
                'nombre' => 'Top Incomes Over the Twentieth Century',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));                                  
    }
 
}