<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

// class school extends Model
// {
//     protected $connection = "mysql";
//     protected $table = "school";
//     protected $primaryKey = "school_id";
//     public $timestamps = false;
//     protected $fillable = ["school_name", "type", "district", "registration_date", "branch_id", "village_id"];

//     public function village(): BelongsTo
//     {
//         return $this->belongsTo(village::class, 'village_id', 'village_id');
//     }
// }
