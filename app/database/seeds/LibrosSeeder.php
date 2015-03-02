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


       DB::table('autores')->insert(array(
            array('nombres' => 'Spiegel','apellidos' => 'Murray R'),
            array('nombres' => 'Carl Barnett','apellidos' => 'Allendoerfer'),
            array('nombres' => 'Fabio','apellidos' => 'Hernández Díaz'),
            array('nombres' => 'Harald','apellidos' => 'Isenstein'),
            array('nombres' => 'Inés','apellidos' => 'Beyer'),
            array('nombres' => 'Roy','apellidos' => 'Richards'),
            array('nombres' => 'Lucia','apellidos' => 'Milande'),
            array('nombres' => 'Jean','apellidos' => 'Cocteau'
            )
        ));

        DB::table('editoriales')->insert(array(
            array('nombre' => 'ABC DIDACTICA'),
            array('nombre' => 'ACTIVIDAD GLOBAL'),
            array('nombre' => 'THORS LTDA'),
            array('nombre' => 'CATORSE S.C.S'),
            array('nombre' => 'DISTRIPESS LTDA '),
            array('nombre' => 'EDITORIAL OVEJA NEGRA')
        ));

        //[{"titulo":"asdf","subtitulo":"asdf","titulooriginal":"adsf","anoedicion":"1900","edicion":"adsf","isbn":"","coleccion":"","infoadicional":""}]


        $Libro1 = Libro::create(array(
                'titulo' => 'Cien años de soledad',
                'subtitulo' => 'Cien años de soledad',
                'titulooriginal' => 'Cien años de soledad',
                'anoedicion' => '1900',
                'edicion' => '1',
                'isbn' => '1',
                'coleccion' => 'pruen'
        ));
        
        // $Libro1 = Libro::create(array(
        //         'nombre' => 'Cien años de soledad',
        //         'autor_id' => $autor1->id,
        //         'editorial_id' => '1',
        //         'ubicacion_id' => '1',
        // ));
        
        //  $Libro2 = Libro::create(array(
        //         'nombre' => 'El capital en el siglo XXI',
        //         'autor_id' => $autor2->id,
        //         'editorial_id' => '1',
        //         'ubicacion_id' => '1',
        // ));
           
        //  $Libro3 = Libro::create(array(
        //         'nombre' => 'The Baffler No. 25',
        //         'autor_id' => $autor2->id,
        //         'editorial_id' => '1',
        //         'ubicacion_id' => '1',
        // ));
        
        // $Libro4 = Libro::create(array(
        //         'nombre' => 'Top Incomes: A Global Perspective',
        //         'autor_id' => $autor2->id,
        //         'editorial_id' => '1',
        //         'ubicacion_id' => '1',
        // ));
        
        // $Libro5 = Libro::create(array(
        //         'nombre' => 'Top Incomes Over the Twentieth Century',
        //         'autor_id' => $autor2->id,
        //         'editorial_id' => '1',
        //         'ubicacion_id' => '1',
        // ));
        
    }
 
}