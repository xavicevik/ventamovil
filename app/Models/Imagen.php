<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable =[
        'idorigen',
        'tabla',
        'nombre',
        'url',
        'extension'
    ];
}
