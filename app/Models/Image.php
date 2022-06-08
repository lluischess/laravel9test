<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Table of the model
    protected $table = 'images';

    // Relation One to Many
    public function comments(){
        // Definimos la relación con otro Modelo/Objeto
        return $this->hasMany('App\Comment');
    }

    // Relation One to Many
    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Relation Many to One
    public function user(){
        // Definimos a que Modelo esta relacionado y a que clave foranea esta ligado de este Modelo(User(id) ->Image(user_id))
        return $this->belongsTo(User::class, 'user_id');
    }

}
