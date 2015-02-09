<?php
class Libro extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Libros';


	public function autor()
    {
        return $this->hasOne('Autor', 'id', 'autor_id');
    }
}