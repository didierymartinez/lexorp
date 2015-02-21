<?php
class Item extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Inventario';

	public function articulo()
	{
		return belongsTo('Articulo');
	}
}