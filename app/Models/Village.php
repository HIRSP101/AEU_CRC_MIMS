<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class village extends Model
{
    protected $connection = "mysql";
    protected $table = "village";
    protected $primaryKey = "village_id";
    public $timestamps = false;
    protected $fillable = ["village_name", "registration_date", "branch_id"];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(branch::class, 'branch_id', 'branch_id');
    }
}
