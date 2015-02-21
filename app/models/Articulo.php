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

    public function Items()
    {
    	return $this->hasMany('Item');
    }

    public function movimientos()
    {
        return $this->hasManyThrough('Movimiento', 'Item','articulo_id','movimiento_id' );
    }
}