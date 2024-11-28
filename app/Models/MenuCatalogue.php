<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MenuCatalogue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu_catalogue';

    protected $fillable = [
        'name',
        'keyword',
        'publish',
    ];


     //hòa
     public function menus(){
        return $this->hasMany(Menu::class, 'menu_catalogue_id', 'id');
    }
}
