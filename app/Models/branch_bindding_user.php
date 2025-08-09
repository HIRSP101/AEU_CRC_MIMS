<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class branch_bindding_user extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_bindding_user";
    protected $primaryKey = "bbu_id";
    protected $timestamp = true;
    protected $fillable = ["branch_id", "user_id", "created_at", "updated_at", "branch_hei_id"];
    public function users(): BelongsTo
    {
        return $this->belongsTo(users::class, 'id', 'user_id');
    }
    public function branch(): BelongsTo
    {
        return $this->belongsTo(branch::class, 'branch_id', 'branch_id');
    }
    public function branch_hei(): BelongsTo
    {
        return $this->belongsTo(branch_hei::class, 'branch_hei_id', 'bhei_id');
    }
}
