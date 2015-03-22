<?php
	class InventarioSeeder extends Seeder {
 
    public function run()
    {
        DB::table('tipos_estado_inventario')->delete();
        DB::table('tipos_movimientos')->delete();
        

        DB::statement('ALTER TABLE tipos_estado_inventario AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_movimientos AUTO_INCREMENT = 1;');
        

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

        $item1 = Item::create(array(
                'placa' => '0101',
                'articulo_id' => '1',
                'estado_id' => '1'
        ));        


               
    }
 
}