<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
