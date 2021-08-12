<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $guarded = [''];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
   
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'slug';
     }

     public function comments(){
        $comments = $this->hasMany(Comment::class);
        foreach ($comments as $c) {
            $c->setAttribute('added_at',$c->created_at->diffForHumans());
        }
        return $comments;
    }
}
