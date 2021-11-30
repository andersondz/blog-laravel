<?php

use App\Http\Controllers\PostControler;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PostControler::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostControler::class, 'show'])->name('posts.show');
Route::get('category/{category}', [PostControler::class,'category'])->name('posts.category');
Route::get('tag/{tag}', [PostControler::class, 'tag'])->name('posts.tag');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 
