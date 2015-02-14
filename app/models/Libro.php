<?php
class Libro extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'libros';


	public function autor()
    {
        return $this->hasOne('Autor', 'id', 'autor_id');
    }
}