<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Boya;

class Conductividad extends Model
{
    protected $fillable = [
        'id_boya',
        'nivel_conductividad'
    ];

    public function boya()
    {
        return $this->belongsTo(Boya::class, 'id_boya');
    }

}
