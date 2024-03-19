<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function category()
    {
        return $this->hasOne(SubCategory::class, 'id', 'category_id');    
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('post_title', 'like', $term);
        });
    }
}
