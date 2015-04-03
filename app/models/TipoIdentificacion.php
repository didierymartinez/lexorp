<?php
class TipoIdentificacion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipos_identificacion';

	public function TipoIdentificacion()
    {
        return $this->hasMany('UsuarioBiblioteca','inventario_id');
    }
}