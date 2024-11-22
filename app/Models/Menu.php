<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;







    //hòa
    public function menu_catalogues(){
        return $this->belongsTo(MenuCatalogue::class, 'menu_catalogue_id', 'id');
    }
}
