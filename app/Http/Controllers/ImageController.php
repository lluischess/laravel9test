<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Este middleware evita que accedan a los metodos por si no estan identificados añadiendo la url manual
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('images.create');
    }



}
