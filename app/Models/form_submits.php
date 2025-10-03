<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_submits extends Model
{
    protected $connection = "mysql";
    protected $table = "form_submits";
    protected $primaryKey = "id";

    protected $fillable = [
        'created_by',
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
