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
    protected $fillable = ["mrd_id", "member_id", "registration_date", "expiration_date"];
    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}
