<?php
class Devolucion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Devoluciones';

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

        static::created(function($Devolucion) { 
	        
            $movimiento = new Movimiento();
            $movimiento->inventario_id = $Devolucion->inventario_id;
            $movimiento = $Devolucion->movimientos()->save($movimiento);

            $item = Item::find($Devolucion->inventario_id);
            $item->ultimoMovimiento_id = $movimiento->id;
            $item->save();

        });
    }    
}