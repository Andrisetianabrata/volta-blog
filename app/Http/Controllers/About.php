<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class About extends Controller
{
    public function about($userName)
    {
        $user = User::where('username', $userName)->first();

        if (!$user) {
            abort(404, 'User tidak ditemukan.');
        }
        $posts = Post::whereHas('author', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->paginate(8);

        return view('front.pages.about', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    
    public function aboutList()
    {
        // $user = User::where('username', $userName)->first();

        // if (!$user) {
        //     abort(404, 'User tidak ditemukan.');
        // }
        // $posts = Post::whereHas('author', function ($query) use ($user) {
        //     $query->where('id', $user->id);
        // })->paginate(8);

        return view('front.pages.about-lists', [
            'users' => User::orderBy('type', 'ASC')
                           ->paginate(8)

        ]);
    }
}
