<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Review extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'score',
        'reviewable_id',
        'reviewable_type',
        'fullname',
        'email',
        'phone',
        'gender',
        'description',
    ];
    public function reviewable()
    {
        return $this->morphTo();
    }
}
