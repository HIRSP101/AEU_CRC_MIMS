<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_engagement_detail extends Model
{
    protected $connection = "mysql";
    protected $table = "member_engagement_detail";
    protected $primaryKey = "med_id";
    public $timestamps = false;
    protected $fillable = ["med_id", "member_id", "branch_id", "recruitment_date"];
    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}
