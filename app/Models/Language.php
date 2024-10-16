<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'canonical',
        'description',
        'publish',
        'image',
        'user_id',
        'item',
        'current'
    ];

    protected $table = 'languages';
}
