<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id', );
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
