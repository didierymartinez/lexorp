<?php
	class LibrosSeeder extends Seeder {
 
    public function run()
    {
       
        
 
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


         $Libro4 = Libro::create(array(
                'nombre' => 'Top Incomes: A Global Perspective',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));

         $Libro5 = Libro::create(array(
                'nombre' => 'Top Incomes Over the Twentieth Century',
                'autor_id' => $autor2->id,
                'editorial_id' => '1',
                'ubicacion_id' => '1',
        ));

        $idTipoArticulo = DB::table('tipos_articulos')->where('tipo', 'Libro')->pluck('id');
        $idTipoCreacion = DB::table('tipos_creacion_articulos')->where('tipo', 'Inventario Inicial')->pluck('id');

        Articulo::create(array(
                'tipo_id' => $idTipoArticulo,
                'articulo_id' => $Libro1->id,
                'tipos_creacion_articulos_id' => $idTipoCreacion          
        ));

        Articulo::create(array(
                'tipo_id' => $idTipoArticulo,
                'articulo_id' => $Libro2->id,
                'tipos_creacion_articulos_id' => $idTipoCreacion          
        ));

        Articulo::create(array(
                'tipo_id' => $idTipoArticulo,
                'articulo_id' => $Libro3->id,
                'tipos_creacion_articulos_id' => $idTipoCreacion          
        ));

        Articulo::create(array(
                'tipo_id' => $idTipoArticulo,
                'articulo_id' => $Libro4->id,
                'tipos_creacion_articulos_id' => $idTipoCreacion          
        ));

        Articulo::create(array(
                'tipo_id' => $idTipoArticulo,
                'articulo_id' => $Libro5->id,
                'tipos_creacion_articulos_id' => $idTipoCreacion          
        ));

    }
 
}