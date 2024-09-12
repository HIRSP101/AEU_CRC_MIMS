<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class member_top_management extends Model
{
    protected $connection = "mysql";
    protected $table = "member_top_management";
    protected $primaryKey = "mtm_id";
    protected $fillable = ["mtm_id", "member_id", "name", "position", "branch_id"];
    protected $timestamps = false;

    public function member_personal_detail(): BelongsTo
    {
        return $this->belongsTo(member_personal_detail::class, 'member_id', 'member_id');
    }
}
