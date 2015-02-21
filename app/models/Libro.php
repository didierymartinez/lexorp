<?php
class Libro extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'libros';


	public function articulos()
    {
        return $this->morphMany('Articulo', 'articulo');
    }


	public function autor()
    {
        return $this->hasOne('Autor', 'id', 'autor_id');
    }


    protected static function boot() {
        parent::boot();

        static::created(function($Libro) { 
	        
	        $Libro->articulos()->save(new Articulo());

        });
    }
}