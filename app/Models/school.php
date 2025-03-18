<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school extends Model
{
    protected $connection = "mysql";
    protected $table = "school";
    protected $primaryKey = "school_id";
    public $timestamps = false;
    protected $fillable = ["school_name", "type", "village_name", "registration_date", "branch_id", "district_id", "khom"];

    public function district()
    {
        return $this->belongsTo(district::class, 'district_id', 'district_id');
    }
}
