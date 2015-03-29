<?php
class Libro extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'libros';


    protected $fillable = array('titulo', 'placa', 'subtitulo', 'titulooriginal', 'edicion', 'anoedicion', 'isbn', 'coleccion', 'editorial_id');


	public function articulos()
    {
        return $this->morphMany('Articulo', 'articulo');
    }


	public function autores()
    {
        return $this->belongsToMany('Autor');
    }

    public function editorial()
    {
        return $this->belongsTo('Editorial');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($Libro) { 
	        
	        $Libro->articulos()->save(new Articulo());

        });
    }
}