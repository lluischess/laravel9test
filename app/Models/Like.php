<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    // Many to One
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    // Many to One
    public function images(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
