<?php
class Autor extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'autores';

		public function autores()
    {
        return $this->belongsToMany('Libro');
    }


	public function getNombreCompletoAttribute()
	{
	    return $this->attributes['nombres'] .' '. $this->attributes['apellidos'];
	}
}