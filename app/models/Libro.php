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

    public function CantidadenPrestamo()
    {
        $cantidad = 0;

        foreach ($this->articulos->first()->items as $item)
        {
            if($item->ultimomovimiento()->first()->movimiento_type == 'Prestamo'){
                $cantidad += 1;
            }
            
        }

        return $cantidad;
    }

    public function enPrestamo()
    {
        $LibrosEnPrestamo = array();
              

        foreach ($this->articulos->first()->items as $item)
        {
            if($item->ultimomovimiento()->first()->movimiento_type == 'Prestamo'){
                 array_push($LibrosEnPrestamo, $item);  
            }
            
        }

        return $LibrosEnPrestamo;
    }

    public function disponibles()
    {
        $LibrosDisponibles = array();
              

        foreach ($this->articulos->first()->items as $item)
        {
            if($item->ultimomovimiento()->first()->movimiento_type != 'Prestamo'){
                 array_push($LibrosDisponibles, $item);  
            }
            
        }

        return $LibrosDisponibles;
    }

    public function total()
    {
        return $this->articulos->first()->items;
    }

    protected static function boot() {
        parent::boot();

        static::created(function($Libro) { 
	        
	        $Libro->articulos()->save(new Articulo());

        });
    }
}