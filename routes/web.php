<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('admin/users',\App\Http\Controllers\Admin\AdminController::class)->middleware('Admin');
Route::resource('admin/posts',\App\Http\Controllers\Admin\AdminPostController::class)->middleware('Admin');
Route::get('admin/rating/posts',[\App\Http\Controllers\PostController::class,'testRating'])->middleware('Admin')->name('testRating');

Route::resource('admin/categories',\App\Http\Controllers\Admin\AdminCategoryController::class)->middleware('Admin');
Route::resource('admin/media',\App\Http\Controllers\Admin\AdminMediaController::class)->except(['show','edit','update'])->middleware('Admin');
Route::get('admin/media/download/{id}',[\App\Http\Controllers\Admin\AdminMediaController::class,'download'])->middleware('Admin')->name('media.download');
Route::resource('admin/comment',\App\Http\Controllers\Admin\CommentController::class)->middleware('Admin');
Route::put('admin/comment/action/{id}',[\App\Http\Controllers\Admin\CommentController::class,'active'])->middleware('Admin')->name('comment.active');
Route::get('admin/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->middleware('Admin')->name('dashboard.index');
Route::delete('admin/delete/photos',[\App\Http\Controllers\Admin\AdminMediaController::class,'deletePhotos'])->middleware('Admin')->name('delete/photos');


Route::get('/',[\App\Http\Controllers\frontPages\MainController::class,'index'])->name('home');
Route::get('posts/{slug}',[\App\Http\Controllers\frontPages\PostController::class,'show'])->name('front.show.post');
Route::get('search',[\App\Http\Controllers\frontPages\PostController::class,'searchTitle'])->name('front.search.post');
Route::get('category/{slug}',[\App\Http\Controllers\frontPages\PostController::class,'category'])->name('front.show.category.posts');
Route::post('comment/{postId}',[\App\Http\Controllers\frontPages\CommentController::class,'store'])->name('front.comment.store');
Route::post('comment',[\App\Http\Controllers\frontPages\CommentController::class,'replies'])->name('front.comment.reply');


