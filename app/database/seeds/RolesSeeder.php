<?php
	class RolesSeeder extends Seeder {
 
    public function run()
    {
        DB::table('roles')->delete();
        $Sistema = Role::create(array(
                'name' => 'Sistema' 
        ));
        $Administrador = Role::create(array(
                'name' => 'Administrador' 
        ));
        $Usuario = Role::create(array(
                'name' => 'Usuario' 
        ));
        
        $permisos = Permission::all();
        
        foreach($permisos as $permiso){
           $Sistema->attachPermission($permiso); 
           $Administrador->attachPermission($permiso); 
        }
    }
 
}