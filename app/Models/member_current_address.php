<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_current_address extends Model
{
    protected $connection = "mysql";
    protected $table = "member_current_address";
    protected $primaryKey = "mca_id";
    public $timestamps = false;
    protected $fillable = ["mca_id", "member_id", "village", "commune_sangkat", "provience_city", "zipcode", "district_khan", "home_no", "street_no"];

    public function member_personal_detail() {
        return $this->belongsTo(member_personal_detail::class, 'member_id');
    }
}