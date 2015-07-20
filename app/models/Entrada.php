<?php
class Entrada extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'entradas';

	protected $fillable = array(
        'inventario_id'
    );

	public function movimientos()
    {
        return $this->morphMany('Movimiento', 'movimiento');
    }

}