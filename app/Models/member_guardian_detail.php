<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_guardian_detail extends Model
{
   protected $connection = "mysql";
   protected $table = "member_guardian_detail";
   protected $primaryKey = "mgd_id";
   public $timestamps = false;
   protected $fillable = ["mgd_id", "member_id", "father_name", "father_dob", "father_current_address", "father_occupation", "mother_name", "mother_dob", "mother_current_address", "mother_occupation"];
   public function member_personal_detail() {
    return $this->belongsTo(member_personal_detail::class, 'member_id');
}
}
