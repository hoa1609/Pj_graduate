<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserCatalogue extends Model
{
    use HasApiTokens, HasFactory, Notifiable, QueryScopes;

    protected $fillable = [
        'name',
        'description',
        'publish',
    ];

    protected $table = 'user_catalogues';

    public function users()
    {
        return $this->hasMany(User::class, 'user_catalogue_id', 'id');
    }
}
