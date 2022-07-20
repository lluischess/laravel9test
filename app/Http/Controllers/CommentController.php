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

    public function delete($id){
        // Take data user identified
        $user = \Auth::user();


        // Take object comment
        $comment = Comment::find($id);

        // Review if id user is the same as the id comment
        if ($user && ($comment->user_id == $user->id || $comment->images->user_id == $user->id)){
            // Delete comment
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->images->id])
                                ->with(['message' => 'A comment has been deleted']);

        }else {
            return redirect()->route('image.detail', ['id' => $comment->images->id])
                                ->with(['message' => 'Error the comment has dont been deleted']);
        }

    }
}
