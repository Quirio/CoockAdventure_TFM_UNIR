<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $guarded = ['id'];
    protected $table = 'users';
}
