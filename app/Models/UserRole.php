<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\QueryScopes;


class UserRole extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;
    
    protected $fillable = [
        'name',
        'description',
        'publish',
    ];

    protected $table = 'user_roles';

    public function users(){
        return $this-> hasMany(User::class, 'user_role_id', 'id');
    }

}
