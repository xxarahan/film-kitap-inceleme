<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitap extends Model
{
    public function yorumlar(){
        return $this->hasMany(Yorum::class);
    }
    protected $fillable = ['title', 'description', 'genre', 'cover_image'];
}
