<?php
class UsuariosSeeder extends Seeder {
  public function run()
  {

      DB::table('tipos_tags')->insert(array(
      array('Tipo' => 'Item'),
      array('Tipo' => 'UsuarioBiblioteca')
    ));


      DB::table('tipos_identificacion')->insert(array(
      array('Tipo' => 'CC','Descripcion' => 'Cedula de Ciudadania' ),
      array('Tipo' => 'TI','Descripcion' => 'Tarjeta de Indentidad' ),
      array('Tipo' => 'RC','Descripcion' => 'Registro Civil' ),
      array('Tipo' => 'CE','Descripcion' => 'Cedula de Extranjeria' )
    ));


    $tag2 = new Tag;
    $tag2->epc = '3008-33B2-DDD9-0140-0000-0000';
    $tag2->save();

    $usuarionuevo = new UsuarioBiblioteca;
    $usuarionuevo->identificacion = '80549322';
    $usuarionuevo->tipoidentificacion= 1;
    $usuarionuevo->nombres = 'Didier';
    $usuarionuevo->apellidos = 'Martinez';
    $usuarionuevo->sexo= 'M';
    $usuarionuevo->fecha_nacimiento = '18/05/1962';
    $usuarionuevo->direccion= 'Calle 143 # 118 - 20 ';
    $usuarionuevo->tel_fijo = '4925632';
    $usuarionuevo->celular = '320256877';
    $usuarionuevo->email = 'usuariobiblioteca@gmail.com';
    $usuarionuevo->tag_id = $tag2->id;
    $usuarionuevo->save();


    $tag2->objeto_id = $usuarionuevo->id;
    $tag2->objeto_type = 'UsuarioBiblioteca';
    $tag2->save();

  }
}