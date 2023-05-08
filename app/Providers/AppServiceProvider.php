<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Setting::all();
        foreach ($setting as $key => $setting) {
            if($key === 0) $system_name = $setting->value;
            elseif($key === 1) $favicon = $setting->value;
            elseif($key === 2) $front_logo = $setting->value; 
            elseif($key === 3) $admin_logo = $setting->value;  
        }

        $categories = Category::where('status',1)->get();
        $author = User::where('id','!=',1)->get();
        $most_viewed = Post::with(['creator','comments'])->where('status',1)->orderBy('view_count','DESC')->limit(5)->get();
        $most_commented = Post::withCount(['comments'])->where('status',1)->orderBy('comments_count','DESC')->limit(5)->get();
        $shareData = array(
            'system_name'=>$system_name,
            'favicon'=>$favicon,
            'front_logo'=>$front_logo,
            'admin_logo'=>$admin_logo,
            'categories'=>$categories,
            'author'=>$author,
            'most_viewed'=>$most_viewed,
            'most_commented'=>$most_commented,
        );
        view()->share('shareData',$shareData);
    }
}
