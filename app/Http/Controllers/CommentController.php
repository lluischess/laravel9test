<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

        //Validation
        $validate = $this->validate($request, [
            'image_id' => ['required'],
            'coment' => ['required', 'string'],
        
        ]);

        $user = \Auth::user();
        $id = \Auth::user()->id;

        $image_id = $request->input('image_id');
        $content = $request->input('coment');

        $comments = new Comment();
        $comments->user_id = $id;
        $comments->image_id = $image_id;
        $comments->content = $content;
        $comments->save();

        return redirect()->route('image.detail', ['id' => $image_id])
                                ->with(['message' => 'Comment posted']);

        
    }
}
