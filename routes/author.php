<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
Route::prefix('author')->name('author.')->group(function () {
  Route::middleware(['web', 'guest'])->group(function(){
    Route::view('/login', 'back.pages.auth.login')->name('login');
    Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
    Route::get('/password/reset{token}', [AuthorController::class, 'ResetForm'])->name('reset-form');
  });

  Route::middleware(['web', 'auth'])->group(function(){
    Route::get('/home', [AuthorController::class, 'index'])->name('home');
    Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
    Route::view('/profile', 'back.pages.profile')->name('profile');
    Route::post('/change-profile-picture', [AuthorController::class, 'changeAuthorPictureFile'])->name('change-profile-picture');
    Route::post('/delete-profile-picture', [AuthorController::class, 'deleteAuthorPictureFile'])->name('delete-profile-picture');
    Route::view('/settings', 'back.pages.settings')->name('settings');
    Route::post('/change-blog-logo-white', [AuthorController::class, 'changeBlogLogoWhite'])->name('change-blog-logo-white');
    Route::post('/change-blog-logo-dark', [AuthorController::class, 'changeBlogLogoDark'])->name('change-blog-logo-dark');
    Route::post('/change-blog-favicon', [AuthorController::class, 'changeBlogFavicon'])->name('change-blog-favicon');
    Route::view('/users', 'back.pages.users')->name('users');
    
    Route::prefix('posts')->name('posts.')->group(function (){
      Route::view('/add-posts', 'back.pages.add-posts')->name('add-post');
      Route::view('/edit-posts', 'back.pages.edit-posts')->name('edit-post');
      Route::view('/all-posts', 'back.pages.all-posts')->name('all-post');
      Route::view('/categories', 'back.pages.categories')->name('categories');
    });
  });
});
