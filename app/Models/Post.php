<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function creator(){
    	return $this->belongsTo('App\Models\User','created_by','id');
    }

     public function comments(){
    	return $this->hasMany('App\Models\Comment');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
}