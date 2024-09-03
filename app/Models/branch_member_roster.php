<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_member_roster extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_member_roster";
    protected $primaryKey = "bmr_id";

}
