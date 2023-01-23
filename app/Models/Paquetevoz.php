<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetevoz extends Model
{
    protected $table = 'paquetesvoz';
    protected $fillable = ['value', 'DESCRIPCION','estado'];

}
