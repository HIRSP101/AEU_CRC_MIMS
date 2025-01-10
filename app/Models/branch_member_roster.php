<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class branch_member_roster extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_member_roster";
    protected $primaryKey = "bmr_id";

    public function branch(): BelongsTo {
        return $this->belongsTo(branch::class, 'foreign_key', 'branch_id');
    }
}
