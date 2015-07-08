<?php
class Item extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Inventario';

	public function Articulo()
    {
        return $this->belongsTo('Articulo');
    }

    public function prestamos()
    {
        return $this->hasMany('Prestamo','inventario_id');
    }   

    public function movimientos()
    {
        return $this->hasMany('Movimiento','inventario_id');
    }   

    public function ultimomovimiento()
    {
        return $this->hasOne('Movimiento', 'id', 'ultimoMovimiento_id');
    } 

    protected static function boot() {
        parent::boot();

        static::created(function($item) { 
	        
       	$entrada = Entrada::create(array(
            'inventario_id' => $item->id
        )); 

        $movimiento = new Movimiento();
        $movimiento->inventario_id = $item->id;
        $movimiento = $entrada->movimientos()->save($movimiento);

        $item->ultimoMovimiento_id = $movimiento->id;
        $item->save();

        });
    }    
}