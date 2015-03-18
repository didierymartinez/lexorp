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
	        
            $movimiento = new Movimiento();
            $movimiento->inventario_id = $Prestamo->inventario_id;
            $movimiento = $Prestamo->movimientos()->save($movimiento);

            $item = Item::find($Prestamo->inventario_id);
            $item->ultimoMovimiento_id = $movimiento->id;
            $item->save();

        });
    }    
}