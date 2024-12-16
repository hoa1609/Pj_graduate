<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class MenuCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'name',
        'keyword',
        'publish',
    ];

    protected $table = 'menu_catalogue';


     //hòa
     public function menus(){
        return $this->hasMany(Menu::class, 'menu_catalogue_id', 'id');
    }
}
