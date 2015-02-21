<?php
class Movimiento extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Movimientos';

	public function movimiento()
    {
        return $this->morphTo();
    }
}