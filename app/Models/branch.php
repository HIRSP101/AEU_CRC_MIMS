<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class branch extends Model
{
    protected $connection = "mysql";
    protected $table = "branch";
    protected $primaryKey = "branch_id";
    protected $timestamp = false;
    protected $fillable = ["branch_name", "branch_kh", "user_id"];
    public function branch_member_roster() :HasMany {
        return $this->hasMany(branch_member_roster::class, 'branch_id', 'branch_id');
    }

    public function branch_contact_detail() :HasOne {
        return $this->hasOne(branch_contact_detail::class, 'branch_id', 'branch_id');
    }

    public function branch_leadership_memberroster() :HasOne {
        return $this->hasOne(branch_leadership_memberroster::class, 'branch_id', 'branch_id');
    }

    public function branch_hei() :HasMany {
        return $this->hasMany(branch_hei::class, 'branch_id', 'branch_id');
    }

    public function branch_institution() :HasMany {
        return $this->hasMany(branch_institution::class, 'branch_id', 'branch_id');
    }

}
