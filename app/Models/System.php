<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'systems';
    protected $primaryKey  = 'id';

    public function languages(){
        return $this->belongsToMany(Language::class, 'system' , 'language_id', 'id')
        ->withPivot(
            'keyword',
            'content',
        )->withTimestamps();
    }


}
