<?php

use App\Http\Controllers\About;
use App\Http\Controllers\AllPost;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'front.pages.home')->name('home');
Route::get('/about-list',[About::class, 'aboutList'])->name('about-list');
Route::get('/about/{username}',[About::class, 'about'])->name('about');
Route::get('/articles', [AllPost::class, 'allPosts'])->name('articles');
Route::get('/article/{slug}', [AllPost::class, 'readPost'])->name('read-post');
Route::get('/category/{slug}', [AllPost::class, 'categoryPost'])->name('category-post');
Route::get('/tags/{slug}', [AllPost::class, 'tagsPost'])->name('tags-post');
Route::get('/post/tag/{slug}', [AllPost::class, 'tagPost'])->name('tag-post');
Route::get('/search', [AllPost::class, 'searchPosts'])->name('search-posts');
