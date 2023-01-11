<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $fillable =[
        'CODIGO',
        'DESCRIPCION',
        'ID_PADRE'
    ];

}
