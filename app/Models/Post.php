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
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'category_id', 'id');    
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('post_title', 'like', $term);
        });
    }
}
