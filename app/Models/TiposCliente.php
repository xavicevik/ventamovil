<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposCliente extends Model
{
    protected $table = 'tipos_clientes';
    protected $fillable = ['CODIGO', 'DESCRIPCION','estado'];

}
