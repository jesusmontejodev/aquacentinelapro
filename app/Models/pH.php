<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Boya;

class pH extends Model
{
    protected $fillable = [
        'id_boya',
        'nivel_ph'
    ];

    public function boya()
    {
        return $this->belongsTo(Boya::class, 'id_boya');
    }

}
