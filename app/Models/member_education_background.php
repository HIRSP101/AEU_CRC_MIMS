<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_education_background extends Model
{
    protected $connection = "mysql";
    protected $table = "member_education_background";
    protected $primaryKey = "meb_id";
    public $timestamps = false;
    protected $fillable = ["meb_id", "member_id", "institute_id", "acadmedic_year", "major", "batch", "shift", "education_level", "language", "branch_id", "branchhei_id", "training_received","school_id", "computer_skill", "misc_skill"];
    use HasFactory;
    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}
