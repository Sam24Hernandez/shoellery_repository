<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    
    // Relación Belongs To / de muchos a uno 
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }  
    
    // Relación One To Many / de uno a muchos
    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');        
    }
    
    // Relación One To Many / de uno a muchos
    public function likes(){
        return $this->hasMany(Like::class);        
    }
            
}
