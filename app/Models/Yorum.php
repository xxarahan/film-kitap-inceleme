<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yorum extends Model
{
    protected $fillable = [
        'film_id',
        'kitap_id',
        'user_id',
        'yorum',
        'rating',
    ];
    public function film(){
        return $this->belongsTo(Film::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
