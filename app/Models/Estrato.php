<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrato extends Model
{
    protected $table = 'estratos';
    protected $fillable = ['CODIGO', 'DESCRIPCION','estado'];

}
