<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function settings(){
        return view('user.settings');
    }

    public function update(Request $request){
       # Como tenemos el namespace en controllers y la carpeta Auth esta dentro le añadimos una contrabarra \Auth
       $id = \Auth::user()->id;
       $name = $request->input('name');
       $surname = $request->input('surname');
       $nick = $request->input('nick');
       $email = $request->input('email');

       var_dump($id);
       var_dump($name);

       die();
    }


}
