<?php
class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

    protected $fillable = array(
        'epc',
        'objeto_id',
        'objeto_type'

    );

	public function objeto()
    {
        return $this->morphTo();
    }

    public function items()
    {
    	return $this->hasMany('Item');
    }

}