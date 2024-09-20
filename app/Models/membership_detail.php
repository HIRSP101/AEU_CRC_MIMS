<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membership_detail extends Model
{
    protected $connection = "mysql";
    protected $table = "membership_detail";
    protected $primaryKey = "ms_id";
    public $fillable = ["ms_id", "member_id", "registration_date", "expiration_date"];
    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}
