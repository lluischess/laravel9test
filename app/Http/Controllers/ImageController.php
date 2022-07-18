<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    // Este middleware evita que accedan a los metodos por si no estan identificados añadiendo la url manual
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('images.create');
    }

    public function save(Request $request){

        //Validation
        $validate = $this->validate($request, [
            'description_img' => ['required'],
            'image_path' => 'required|mimes:jpeg,jpg,png',
        
        ]);

        // save data
        $img_path = $request->file('image_path');
        $description = $request->input('description_img');

        //new object
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->image_path = null;
        $image->description = $description;

        // Upload img
        if ($img_path){
            $img_name = time(). $img_path->getClientOriginalName(); 
            Storage::disk('images')->put($img_name, File::get($img_path));
            $image->image_path = $img_name;
        }

        $image->save();
        
        return redirect()->route('home')
                                ->with(['message' => 'Image upload']);

        
    }

    public function getImg($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);
        if($image){
            return view('images.detail', [
                'image'=>$image
            ]);
        }else{ 
            return redirect()->route('image.home')->with(['message'=>'Imagen Incorrecta']);
        }
    }


}
