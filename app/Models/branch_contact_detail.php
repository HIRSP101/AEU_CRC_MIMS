<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_contact_detail extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_contact_detail";
    protected $primaryKey = "bcd_id";


    public function branch(): BelongsTo {
        return $this->belongsTo(branch::class, 'foreign_key', 'branch_id');
    }
}
