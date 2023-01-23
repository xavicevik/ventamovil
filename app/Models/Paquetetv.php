<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetetv extends Model
{
    protected $table = 'paquetestv';
    protected $fillable = ['value', 'DESCRIPCION','estado'];

}
