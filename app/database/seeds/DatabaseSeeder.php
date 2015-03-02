<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('PermisionsSeeder');
        $this->call('RolesSeeder');
		$this->call('UserSeeder');
		$this->call('ArticulosSeeder');
		$this->call('LibrosSeeder');
		//$this->call('InventarioSeeder');		
        $this->command->info('Datos insertados!');
	}

}
