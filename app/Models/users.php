<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class users extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
}
