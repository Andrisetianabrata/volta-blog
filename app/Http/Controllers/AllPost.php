<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AllPost extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        }else{
            $subCategory = SubCategory::where('slug', $slug)->first();
            if (!$subCategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subCategory->id)
                             ->orderBy('created_at', 'desc')
                             ->paginate(6);

                $data = [
                    'pageTitle' => 'Category - '.$subCategory->subcategory_name,
                    'category' => $subCategory,
                    'posts' => $posts,
                ];

                return view('front.pages.category-posts', $data);    
            }
        }
    }

    public function allPosts()
    {
        $subCategory = SubCategory::all();
        $posts = Post::with(['author', 'category'])
               ->orderBy('created_at', 'desc')
               ->paginate(6);

        $data = [
            'category' => $subCategory,
            'posts' => $posts,
        ];
        return view('front.pages.all-posts', $data);
    }

    public function readPost(Request $request, $slug)
    {
        $post = Post::where('post_slug', $slug)->first();
        $data = [
            'pageTitle' => $post->post_title,
            'post' => $post,
        ];
        // return dd($data);
        return view('front.pages.content-post', $data);    
    }
    
}
