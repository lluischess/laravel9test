<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Este middleware evita que accedan a los metodos por si no estan identificados añadiendo la url manual
    public function __construct(){
        $this->middleware('auth');
    }

    public function settings(){
        return view('user.settings');
    }

    public function update(Request $request){

        # Como tenemos el namespace en controllers y la carpeta Auth esta dentro le añadimos una contrabarra \Auth
        # $User = usuer identifier in this moment
        $user = \Auth::user();
        $id = \Auth::user()->id;
        
        // validate for backend data
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id], // es una excepcion que el nick coincida con el $id
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        
        ]);
       
       // Save data form
       $name = $request->input('name');
       $surname = $request->input('surname');
       $nick = $request->input('nick');
       $email = $request->input('email');

       // Add new data to settings form
       $user->name = $name;
       $user->surname = $surname;
       $user->nick = $nick;
       $user->email = $email;

       // Upload Img to Server
       $img_avatar = $request->file('img_avatar');
       
       if ($img_avatar){
            $img_avatar_name = time(). $img_avatar->getClientOriginalName(); 
            Storage::disk('users')->put($img_avatar_name, File::get($img_avatar));
            $user->img = $img_avatar_name;
        }

       // Execute SQL query on BBDD
       $user->update();

       return redirect()->route('settings')
                                ->with(['message' => 'User updated']);

    }

    public function get_img_avatar($file_name){
        $file = Storage::disk('users')->get($file_name);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);

        return view('user.profile', [
			'user' => $user
		]);
    }

    public function users($search = null){

        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('surname', 'LIKE', '%'.$search.'%')
                            ->orderBy('id','desc')->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }


        return view('user.index', [
			'users' => $users
		]);
    }


}
