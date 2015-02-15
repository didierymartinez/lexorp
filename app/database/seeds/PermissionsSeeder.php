<?php
	class PermisionsSeeder extends Seeder {
 
    public function run()
    {

    
    DB::table('assigned_roles')->delete();
    DB::table('permission_role')->delete();
    DB::table('permissions')->delete();

        DB::statement('ALTER TABLE assigned_roles AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE permission_role AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1;');


    $ver_usuarios = new Permission();
    $ver_usuarios->name = 'ver_usuarios';
    $ver_usuarios->display_name = 'Ver Usuarios';
    $ver_usuarios->save();
    
    $ver_roles = new Permission();
    $ver_roles->name = 'ver_roles';
    $ver_roles->display_name = 'Ver Roles';
    $ver_roles->save();
    
    $crear_roles = new Permission();
    $crear_roles->name = 'crear_roles';
    $crear_roles->display_name = 'Crear Roles';
    $crear_roles->save();
    
    $crear_usuarios = new Permission();
    $crear_usuarios->name = 'crear_usuarios';
    $crear_usuarios->display_name = 'Crear Usuarios';
    $crear_usuarios->save();
    
    $editar_roles = new Permission();
    $editar_roles->name = 'editar_roles';
    $editar_roles->display_name = 'Editar Roles';
    $editar_roles->save();
    
    $editar_usuarios = new Permission();
    $editar_usuarios->name = 'editar_usuarios';
    $editar_usuarios->display_name = 'Editar Usuarios';
    $editar_usuarios->save();
    
    $eliminar_usuarios = new Permission();
    $eliminar_usuarios->name = 'eliminar_usuarios';
    $eliminar_usuarios->display_name = 'Eliminar Usuarios';
    $eliminar_usuarios->save();
    
    $eliminar_roles = new Permission();
    $eliminar_roles->name = 'eliminar_roles';
    $eliminar_roles->display_name = 'Eliminar Roles';
    $eliminar_roles->save();
    }
    
}