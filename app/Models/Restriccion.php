<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restriccion extends Model
{
    protected $table = 'restricciones';
    protected $fillable = ['CODIGO', 'DESCRIPCION','estado'];

}
