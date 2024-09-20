<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
class users extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $connection = "mysql";
    protected $table = "users";
    protected $fillable = ['name', 'email', 'password', 'image'];
    protected $primaryKey = 'id';
    public function branch(): HasMany
    {
        return $this->hasMany(branch::class, 'user_id', 'id');
    }
}
