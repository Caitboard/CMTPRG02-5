<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'rating', 'review', 'image', 'watched_at', 'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
