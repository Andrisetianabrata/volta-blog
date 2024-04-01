<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AllPost extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $subCategory = SubCategory::where('slug', $slug)->first();
            if (!$subCategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subCategory->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

                $data = [
                    'pageTitle' => 'Category - ' . $subCategory->subcategory_name,
                    'category' => $subCategory,
                    'posts' => $posts,
                ];

                return view('front.pages.category-posts', $data);
            }
        }
    }

    public function tagsPost(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$slug || $category == null) {
            return abort(404);
        } else {
            $category = Category::where('slug', $slug)->first();
            $subCategories = $category->subCategories;
            
            $posts = Post::whereHas('category', function ($query) use ($subCategories) {
                $query->whereIn('id', $subCategories->pluck('id'));
            })->paginate(8);

            $data = [
                'posts' => $posts,
                'category' => $category,
                'subCategories' => $subCategories,
            ];

            return view('front.pages.tags-posts', $data);
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
            'users' => User::inRandomOrder()->first()
        ];
        // return dd($data);
        return view('front.pages.content-post', $data);
    }

    public function searchPosts(Request $reques)
    {
        $query = request()->query('query');
        $searchValue = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
        $posts = Post::query();

        $posts->where(function($q) use ($searchValue) {
            foreach ($searchValue as $value) {
                $q->orWhere('post_title', 'LIKE', "%{$value}%");
            } 
        });

        $posts = $posts->with('category')
                        ->with('author')
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);
        $data = [
            'pageTitle' => 'Search For '. request()->query('query'),
            'query' => request()->query('query'),
            'posts' => $posts
        ];

        return view('front.pages.search-posts', $data);
    }
}
