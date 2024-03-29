<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestMail;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::delete('delete-posts/{user}', [PostController::class, 'deletePostsByUser'])
    ->name('delete-posts-by-user');

Route::get('/users/{user}/posts', [PostController::class, 'getPostsByUser'])->name('users_posts');

Route::get('/home',[PostController::class, 'index'])->name('home');

Route::get('/news', [NewController::class, 'index'])->name('allpost.list');

Route::resource('post', PostController::class)->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/news', [NewController::class, 'index']);
Route::get('/news/{slug}', [NewController::class, 'show'])->name('news.show');;
require __DIR__.'/auth.php';

