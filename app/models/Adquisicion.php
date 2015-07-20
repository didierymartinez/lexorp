<?php
class Adquisicion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'adquisiciones';

     protected $fillable = array(
        'Fecha',
        'Tipo',
        'Cantidad',
        'Proveedor'
    );


	public function setFechaAttribute($fecha) {
        if ($fecha) {
            $date = DateTime::createFromFormat('d/m/Y', $fecha);            
            $this->attributes['fecha'] = $date->format('Y-m-d');
        } else {
            $this->attributes['fecha'] = '';
        }
    }

    public function getFechaAttribute() {
        $tmpdate = $this->attributes['fecha'];
        if ($tmpdate == "0000-00-00" || $tmpdate == "") {
            return "";
        } else {
            return date('d/m/Y',strtotime($tmpdate));
        }
    }     

}