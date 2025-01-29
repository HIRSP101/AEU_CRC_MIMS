<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $connection = "mysql";
    protected $table = "village";
    protected $primaryKey = "village_id";
    protected $fillable = ["village_name", "registration_date"];
}
