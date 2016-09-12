<?php
	class EliminardatosSeeder extends Seeder {
 
    public function run()
    {

        DB::table('autor_libro')->delete();
        DB::table('libros')->delete();
        DB::table('autores')->delete();

        DB::table('movimientos')->delete();
        DB::table('entradas')->delete();
        DB::table('inventario')->delete();
        DB::table('articulos')->delete();

        DB::table('tipos_articulos')->delete();


        DB::table('assigned_roles')->delete();
        DB::table('permission_role')->delete();
        DB::table('permissions')->delete();

        DB::table('roles')->delete();
        DB::table('usuariosbiblioteca')->delete();
        DB::table('users')->delete();

        DB::table('tipos_estado_inventario')->delete();
        DB::table('tipos_movimientos')->delete();

        DB::table('usuariosbiblioteca')->delete();

        DB::table('tipos_identificacion')->delete();

        DB::table('tags')->delete();

        DB::table('tipos_tags')->delete();

        DB::statement('ALTER TABLE tipos_tags AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tags AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_identificacion AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE usuariosbiblioteca AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_estado_inventario AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_movimientos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE usuariosbiblioteca AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE libros AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE autores AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE articulos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE inventario AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE movimientos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE entradas AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE prestamos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE devoluciones AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE tipos_articulos AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE assigned_roles AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE permission_role AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1;');


    }
    
}