<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class branch extends Model
{
    protected $connection = "mysql";
    protected $table = "branch";
    protected $primaryKey = "branch_id";

    public function branch_member_roster() :HasMany {
        return $this->hasMany(branch_member_roster::class, 'foreign_key', 'branch_id');
    }

    public function branch_contact_detail() :BelongsTo {
        return $this->belongsTo(branch_contact_detail::class, 'foreign_key', 'branch_id');
    }

    public function branch_leadership_memberroster() :BelongsTo {
        return $this->belongsTo(branch_leadership_memberroster::class, 'foreign_key', 'branch_id');
    }

}
