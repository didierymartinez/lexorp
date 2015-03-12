<?php
class Articulo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articulos';


	public function articulo()
    {
        return $this->morphTo();
    }

    public function items()
    {
    	return $this->hasMany('Item');
    }

    public function movimientos()
    {
        return $this->hasManyThrough('Movimiento', 'Item','articulo_id','inventario_id' );
    }
}