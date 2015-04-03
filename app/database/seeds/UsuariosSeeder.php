<?php
class UsuariosSeeder extends Seeder {
  public function run()
  {
    DB::table('usuariosbiblioteca')->delete();  
    DB::statement('ALTER TABLE usuariosbiblioteca AUTO_INCREMENT = 1;');

    DB::table('tipos_identificacion')->delete();
    DB::statement('ALTER TABLE tipos_identificacion AUTO_INCREMENT = 1;');
    

    DB::table('tipos_identificacion')->insert(array(
      array('Tipo' => 'CC','Descripcion' => 'Cedula de Ciudadania' ),
      array('Tipo' => 'TI','Descripcion' => 'Tarjeta de Indentidad' ),
      array('Tipo' => 'RC','Descripcion' => 'Registro Civil' ),
      array('Tipo' => 'CE','Descripcion' => 'Cedula de Extranjeria' )
    ));


    $usuarionuevo = new UsuarioBiblioteca;    
    $usuarionuevo->identificacion = '123456789';
    $usuarionuevo->tipoidentificacion= 1;
    $usuarionuevo->nombres = 'Usuario';
    $usuarionuevo->apellidos = 'Biblioteca';
    $usuarionuevo->sexo= 'M';
    $usuarionuevo->fecha_nacimiento = '18/05/1962';
    $usuarionuevo->direccion= 'Calle 143 # 118 - 20 ';
    $usuarionuevo->tel_fijo = '4925632';
    $usuarionuevo->celular = '320256877';
    $usuarionuevo->email = 'usuariobiblioteca@gmail.com';

    $usuarionuevo->save();
  }
}