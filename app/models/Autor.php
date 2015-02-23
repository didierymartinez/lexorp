<?php
class Autor extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'autores';

	public function getNombreCompletoAttribute()
	{
	    return $this->attributes['nombres'] .' '. $this->attributes['apellidos'];
	}
}