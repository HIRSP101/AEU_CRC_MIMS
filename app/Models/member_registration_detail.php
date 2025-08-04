<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_registration_detail extends Model
{
    protected $connection = "mysql";
    protected $table = "member_registration_detail";
    protected $primaryKey = "mrd_id";
    public $timestamps = false;
    protected $fillable = ["mrd_id", "member_id", "registration_date", "expiration_date","approved","form_submits_id","scout_youth_registration_date","other_ngos_registration_date","uyfc_registration_date"];
    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}
