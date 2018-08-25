<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tags');
    }

    public function post_likes(){
        return $this->hasMany('App\PostLikes');
    }

    public function getFormattedCreatedDateAttribute(){
        // return $this->created_at->toFormattedDateString();
        return $this->created_at->diffForHumans();
    }
}
