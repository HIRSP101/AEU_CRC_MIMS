<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_form_tokens extends Model
{
    protected $connection = "mysql";
    protected $table = "user_form_tokens";
    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'token',
        'starts_at',
        'expires_at',
        'academic_year',
    ];
    use HasFactory;
    public $timestamps = true;
    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
    protected $hidden = [
        'token',
        'created_at',
        'updated_at',
    ]; 
}
