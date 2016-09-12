<?php
	class InventarioSeeder extends Seeder {
 
    public function run()
    {


        DB::table('tipos_estado_inventario')->insert(array(
        	array('Tipo' => 'Disponible'),
            array('Tipo' => 'Inactivo'),
        	array('Tipo' => 'Reservado'),
            array('Tipo' => 'Prestado'),            
            array('Tipo' => 'Traslado')
        ));

        DB::table('tipos_movimientos')->insert(array(
            array('Tipo' => 'Entrada'),
            array('Tipo' => 'Salida'), 
            array('Tipo' => 'Prestamo'),
            array('Tipo' => 'Devolucion'),
            array('Tipo' => 'Reserva'),
            array('Tipo' => 'Traslado')
        ));



        $tag1 = new Tag;
        $tag1->epc = '9230-2010-0000-001A-0000-0705';
        $tag1->save();

        $item1 = Item::create(array(
                'placa' => '0101',
                'articulo_id' => '1',
                'estado_id' => '1',
                'tag_id' => $tag1->id
        ));

        $tag1->objeto_id = $item1->id;
        $tag1->objeto_type = 'Item';
        $tag1->save();




    }
 
}