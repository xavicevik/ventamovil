<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected $table = 'barrios';
    protected $fillable =[
        'CODIGO',
        'DESCRIPCION',
        'ID_PADRE'
    ];

}
