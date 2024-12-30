<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Film extends Model
{
    public function yorumlar(){
        return $this->hasMany(Yorum::class);
    }
    protected $fillable = ['title', 'description', 'genre', 'cover_image'];
   /* public function index(){
        $filmler = Film::all();
        return view('layout', compact('filmler'));
    }*/

    
}
