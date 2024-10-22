<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'name',
        'canonical',
    ]; 


    protected $table = 'permissions';

    public function user_catalogues(){
        return  $this->belongsToMany(UserRole::class, 'user_role_permission' , 'permission_id', 'user_role_id');
    }

    
}
