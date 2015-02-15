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
}