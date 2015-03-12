<?php
class Item extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Inventario';

	public function Articulo()
    {
        return $this->belongsTo('Articulo');
    }

    public function prestamos()
    {
        return $this->hasMany('Prestamo','inventario_id');
    }   
}