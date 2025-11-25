<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Boya extends Model
{
    //
    protected $fillable = [
        'id_user',
        'codigo_de_canjeo',
        'nombre',
        'latitud',
        'longitud',
        'modelo',
        'fecha_fabricacion',
        'fecha_mantenimiento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ph()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
