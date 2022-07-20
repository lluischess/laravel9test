<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        $user = \Auth::user();
        
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;

            // Guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'This like exists'
            ]);
        }
    }

    public function dislike($image_id)
    {
        // Recoger datos del usuario y la imagen
        $user = \Auth::user();

        // Condicion para ver si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {

            // Eliminar like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'you take off the like'
            ]);
        } else {
            return response()->json([
                'message' => 'The like dosent exists'
            ]);
        }
    }
}
