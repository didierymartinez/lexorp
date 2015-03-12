<?php
class Prestamo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Prestamos';

	public function movimientos()
    {
        return $this->morphMany('Movimiento', 'movimiento');
    }

	public function item()
    {
        return $this->hasOne('Item');
    }    

    protected static function boot() {
        parent::boot();

        static::created(function($Prestamo) { 
	        
	        $Prestamo->movimientos()->save(new Movimiento());

        });
    }    
}