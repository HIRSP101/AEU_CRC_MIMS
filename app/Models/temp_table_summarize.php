<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_table_summarize extends Model
{
    protected $connection = "mysql";
    protected $table = "temp_table_summarize";
    protected $primaryKey = "id";
}
