<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class branch_institution extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_institution";
    protected $primaryKey = "bi_id";
    protected $timestamp = true;
    protected $fillable = ["branch_id", "institute_name", "institute_kh", "type", "image", "village", "commune_sangkat", "district_khan", "provience_city", "registered_at", "established_at"];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(branch::class, 'branch_id', 'branch_id');
    }
}
