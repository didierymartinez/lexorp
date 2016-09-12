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
        $tag1->epc = '0000-83A3-0000-0066-0000-0168';
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


        $tag2 = new Tag;
        $tag2->epc = '9370-2110-0000-001A-0000-0C5E';
        $tag2->save();

        $item2 = Item::create(array(
                'placa' => '0202',
                'articulo_id' => '2',
                'estado_id' => '1',
                'tag_id' => $tag2->id
        ));

        $tag2->objeto_id = $item2->id;
        $tag2->objeto_type = 'Item';
        $tag2->save();

    }
 
}