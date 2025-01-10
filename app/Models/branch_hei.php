<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class branch_hei extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_hei";
    protected $primaryKey = "bhei_id";
    protected $timestamp = true;
    protected $fillable = ["branch_id", "institute_name", "institute_kh", "type", "image", "village", "commune_sangkat", "district_khan", "provience_city", "registered_at", "established_at", "institute_type"];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(branch::class, 'branch_id', 'branch_id');
    }
}
