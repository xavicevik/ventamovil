<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    protected $table = 'tecnologias';
    protected $fillable = ['CODIGO', 'DESCRIPCION','estado'];

}
