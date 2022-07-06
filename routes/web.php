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
Route::get('/', function () {
    return view('home');
});

// Show PHP versión:
Route::get('/php', function(){
    return view('phpinfo');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Settings
Route::get('/settings', [\App\Http\Controllers\UserController::class, 'settings'])->name('settings');