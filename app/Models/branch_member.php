<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_member extends Model
{
    protected $connection = "mysql";
    protected $table = "branch_member";
    protected $primaryKey = "branch_member_id";
}
