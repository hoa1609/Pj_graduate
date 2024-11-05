<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class PostCatalogue extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'lft',
        'rgt',
        'parent_id',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'follow',
        'canonical',
        'order',
        'user_id',
    ];

    protected $table = 'post_catalogues';

    public function languages(){
        return $this->belongsToMany(Language::class, 'post_catalogue_language' , 'post_catalogue_id', 'language_id')
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

    public function post_catalogue_language(){
        return $this->hasMany(PostCatalogueLanguage::class, 'post_catalogue_id', 'id')->where('language_id','=',1);
    }

}
