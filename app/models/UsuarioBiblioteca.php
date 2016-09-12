<?php
class UsuarioBiblioteca extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuariosbiblioteca';

     protected $fillable = array(
        'user_id',
        'identificacion',
        'tipoidentificacion',
        'nombres',
        'apellidos',
        'sexo',
        'fecha_nacimiento',
        'direccion',
        'tel_fijo',
        'celular',
        'email',
        'activo'
    );


    public function setFechaNacimientoAttribute($fecha_nacimiento) {
        if ($fecha_nacimiento) {
            $date = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento);            
            $this->attributes['fecha_nacimiento'] = $date->format('Y-m-d');
        } else {
            $this->attributes['fecha_nacimiento'] = '';
        }
    }

    public function getFechaNacimientoAttribute() {
        $tmpdate = $this->attributes['fecha_nacimiento'];
        if ($tmpdate == "0000-00-00" || $tmpdate == "") {
            return "";
        } else {
            return date('d/m/Y',strtotime($tmpdate));
        }
    }     

	public function User()
    {
        return $this->belongsTo('User');
    }

    public function tipoIdentificacion()
    {
        return $this->belongsTo('TipoIdentificacion','tipoidentificacion');
    }
  
    public function getNombreCompletoAttribute()
    {
        return $this->attributes['nombres'] .' '. $this->attributes['apellidos'];
    }

    public function tag()
    {
        return $this->hasOne('Tag', 'id', 'tag_id');
    }

    protected static function boot() {
        parent::boot();

        static::creating(function($usuariobiblioteca) { 
	        
       	$user = new User();
        $user->identificacion = $usuariobiblioteca->identificacion;
        $user->first_name = $usuariobiblioteca->nombres;
        $user->last_name = $usuariobiblioteca->apellidos;
        $user->email = $usuariobiblioteca->email;
        $user->password = Hash::make($usuariobiblioteca->identificacion);
        $user->sys = 0;
        $user->active = 1;
        $user->save();
        
        $rol = DB::table('roles')->where('name', 'Usuario')->first();

        $user->attachRole($rol->id);

        $usuariobiblioteca->user_id = $user->id;

        });
    }    
}