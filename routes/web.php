<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;

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

// Home
// Route::get('/', function () {

//     // Recorrer el objeto Image
//     $images = Image::all();
//     foreach( $images as $img){
//         echo $img->image_path . "<br>";
//         echo $img->description . "<br>";
//         echo $img->user->name;
//         echo "COMENTARIOS";
//         echo "<br>";
//         foreach ($img->comments as $comment) {
//             echo $comment->user->name . " " . $comment->user->surname . "<br>";
//             echo $comment->content . "<br>";
//         }
//         echo "<br>";
//     }


//     return view('welcome');
// });

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//---------------------------------
// Show PHP versión:
Route::get('/php', function(){
    return view('phpinfo');
});
//---------------------------------
Auth::routes();
//---------------------------------
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//---------------------------------

// Settings
Route::get('/settings', [\App\Http\Controllers\UserController::class, 'settings'])->name('settings');
// Edit Settings
Route::post('/user/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
// Avatar Settings
Route::get('/user/avatar/{filename}', [\App\Http\Controllers\UserController::class, 'get_img_avatar'])->name('user.avatar');
//---------------------------------

// Add Images
Route::get('/addimage', [\App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
// Save Images
Route::post('/image/save', [\App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
// Img Images
Route::get('/image/file/{filename}', [\App\Http\Controllers\ImageController::class, 'getImg'])->name('image.file');
//---------------------------------

// Img Detail
Route::get('/image/{id}', [\App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
//---------------------------------

// Save Comment
Route::post('/coment/save', [\App\Http\Controllers\CommentController::class, 'store'])->name('coment.save');
// Delete Comment
Route::get('/comment/{id}', [\App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
//---------------------------------

// Save Like
Route::get('/like/{image_id}', [\App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
// Save Dislike
Route::get('/dislike/{image_id}', [\App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');



    