<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personajes extends Model
{
    protected $guarded = ['id'];
    protected $table = 'personaje';
}
