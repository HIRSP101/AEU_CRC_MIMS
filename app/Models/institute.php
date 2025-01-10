<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class institute extends Model
{
    protected $connection = "mysql";
    protected $table = "institute";
    protected $primaryKey = "institute_id";
    public $fillable = ["institute_id", "name", "type", "branch_id"];
    public function branch(): BelongsTo
    {
        return $this->belongsTo(branch::class, 'branch_id', 'branch_id');
    }
}
