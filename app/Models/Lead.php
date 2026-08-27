<?php

namespace App\Models;
  use HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    

    //le damos permiso a laravel para llenar las columnas 
    protected $fillable = ['resumen_proyecto','estado'];
}
