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
    public $timestamps = true;
    protected $fillable = ["member_id", "member_code", "name_kh", "name_en", "gender", "nationality", "date_of_birth", "member_image", "full_current_address", "phone_number", "guardian_phone", "national_id", "shirt_size", "member_type", "email", 'facebook'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($member) {
            $member->member_guardian_detail()->delete();
            $member->member_engagement_detail()->delete();
            $member->member_registration_detail()->delete();
            $member->member_education_background()->delete();
            $member->member_pob_address()->delete();
            $member->member_current_address()->delete();
            $member->member_top_management()->delete();
            $member->member_middle_management()->delete();
        });
    }

    public function member_guardian_detail(): HasOne
    {
        return $this->hasOne(member_guardian_detail::class, 'member_id');
    }
    public function member_engagement_detail(): HasOne
    {
        return $this->hasOne(member_engagement_detail::class, 'member_id');
    }
    public function member_registration_detail(): HasOne
    {
        return $this->hasOne(member_registration_detail::class, 'member_id');
    }
    public function member_education_background(): HasOne
    {
        return $this->hasOne(member_education_background::class, 'member_id');
    }
    public function member_pob_address(): HasOne
    {
        return $this->hasOne(member_pob_address::class, 'member_id');
    }
    public function member_current_address(): HasOne
    {
        return $this->hasOne(member_current_address::class, 'member_id');
    }
    public function member_top_management(): HasOne
    {
        return $this->hasOne(member_top_management::class, 'member_id');
    }
    public function member_middle_management(): HasOne
    {
        return $this->hasOne(member_middle_management::class, 'member_id');
    }
}
