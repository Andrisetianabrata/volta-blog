<?php

use App\Models\Post;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\User;

if (!function_exists('blogInfo')) {
  function blogInfo()
  {
    return Setting::findOrFail(1);
  }
}

if (!function_exists('userInfo')) {
  function userInfo($id)
  {
    return User::findOrFail($id);
  }
}

if (!function_exists('shortTitle')) {
  function shortTitle($title, $value = 45) {
      if (strlen($title) > $value) {
          return substr($title, 0, $value - 3) . '...';
      } else {
          return $title;
      }
  }
}

if (!function_exists('dateFormat')) {
  function dateFormat($date)
  {
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
  }
}

if (!function_exists('wordsExcerpt')) {
  function wordsExcerpt($value, $words = 15, $end = '...')
  {
    return Str::words(strip_tags($value), $words, $end);
  }
}

if (!function_exists('singleLatestPost')) {
  function singleLatestPost()
  {
    return Post::with(['author', 'category'])
               ->limit(1)
               ->orderBy('created_at', 'desc')
               ->first();
  }
}

if (!function_exists('latestPostList')) {
  function latestPostList()
  {
    return Post::with(['author', 'category'])
               ->orderBy('created_at', 'desc')
               //  ->paginate(7);
               ->skip(1)
               ->limit(6)
               ->get();
  }
}


if (!function_exists('recomendedPosts')) {
  function recomendedPosts($value)
  {
    return Post::with(['author', 'category'])
               ->skip(1)
               ->limit($value)
               ->inRandomOrder()
               ->get();
  }
}

if (!function_exists('categories')) {
  function categories()
  {
    return SubCategory::whereHas('posts')
                      ->with('posts')
                      ->orderBy('subcategory_name', 'asc')
                      ->get();
  }
}