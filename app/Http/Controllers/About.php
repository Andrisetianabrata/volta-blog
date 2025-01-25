<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Str;

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

        SEOMeta::setTitle("About ".$user->name);
        SEOMeta::setDescription(Str::limit(strip_tags($user->biography), 200)); 
        SEOMeta::setCanonical(url()->current());

        // JsonLd::setTitle("About ".$user->name);
        JsonLd::setDescription(Str::limit(strip_tags($user->biography), 200));
        
        OpenGraph::setTitle("About ".$user->name);
        OpenGraph::setDescription(Str::limit(strip_tags($user->biography), 200));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage($user->banner);

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
