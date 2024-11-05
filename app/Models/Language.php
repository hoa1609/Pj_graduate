<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Language extends Model
{
    use HasFactory, QueryScopes;
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
    public function languages(){
        return $this->belongsToMany(PostCatalogue::class, 'post_catalogue_language' , 'language_id', 'post_catalogue_id')
        ->withPivot(
            'post_catalogue_id',
            'language_id',
            'name',
            'canonical',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'description',
            'content'
        )->withTimestamps();
    }
}
