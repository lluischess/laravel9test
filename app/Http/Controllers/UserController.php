<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{
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

       // Execute SQL query on BBDD
       $user->update();

       return redirect()->route('settings')
                                ->with(['message' => 'User updated']);

    }


}
