<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class member_personal_detail extends Model
{
    protected $connection = "mysql";
    protected $table = "member_personal_detail";
    protected $primaryKey = "member_id";
    public $timestamps = false;
    protected $fillable = ["member_id", "name_kh", "name_en", "gender", "nationality", "date_of_birth", "image", "current_address", "phone_number", "guardian_phone", "national_id"];

    public function member_guardian_detail() :HasOne {
        return $this->hasOne(member_guardian_detail::class, 'member_id');
    }

    public function member_engagement_detail() :HasOne {
        return $this->hasOne(member_engagement_detail::class, 'member_id');
    }

    public function member_registration_detail() :HasOne {
        return $this->hasOne(member_registration_detail::class, 'member_id');
    }

    public function member_education_background() :HasOne {
        return $this->hasOne(member_education_background::class, 'member_id');
    }
}
