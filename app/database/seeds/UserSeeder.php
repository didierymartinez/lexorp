<?php
class UserSeeder extends Seeder {
  public function run()
  {
    DB::table('users')->delete();  
    DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');

    $userSis = User::create(array(
      'id' => 1,
      'identificacion' => 'Sistema',
      'first_name' => 'Sistema',
      'last_name' => 'Proxel',
      'email' => 'sistema@proxel.com',
      'password' => Hash::make('1234'),
      'sys' => true,
      'created_at' => new DateTime,
      'updated_at' => new DateTime      
    ));

    $roleSis = Role::where('name', '=', 'Sistema')->get()->first();
    $userSis->attachRole( $roleSis );


    $userAdm = User::create(array(
      'id' => 2,
      'identificacion' => 'Administrador',
      'first_name' => 'Administrador',
      'last_name' => 'Biblioteca',
      'email' => 'AdminBiblioteca@proxel.com',
      'password' => Hash::make('1234'),
      'sys' => true,
      'created_at' => new DateTime,
      'updated_at' => new DateTime      
    ));


    $roleAdm = Role::where('name', '=', 'Administrador')->get()->first();
    $userAdm->attachRole( $roleAdm );

    $userUsu = User::create(array(
      'id' => 3,
      'identificacion' => 'Usuario',
      'first_name' => 'Usuario',
      'last_name' => 'Biblioteca',
      'email' => 'UsuarioBiblioteca@proxel.com',
      'password' => Hash::make('1234'),
      'sys' => true,
      'created_at' => new DateTime,
      'updated_at' => new DateTime      
    ));

    $roleUsu = Role::where('name', '=', 'Usuario')->get()->first();
    $userUsu->attachRole( $roleUsu );
  }
}