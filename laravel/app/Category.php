<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function user() {
        return$this->belongsTo(User::class);
    }
}
