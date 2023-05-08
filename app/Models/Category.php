<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public static function search($request){
        $categories = Category::query();
        if (isset($request['search'])) {
            $categories = $categories->where('name', 'like', '%'.$request['search'].'%');
        }
        return $categories->paginate(1);
    }
}