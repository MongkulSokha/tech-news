<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Post;
use App\Models\Category;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_name = 'Posts';
        if (Auth::user()->type === 1 || Auth::user()->hasRole('Editor')) {
            $data = Post::with(['creator'])->orderBy('id','DESC')->get();
        }else{
            $data = Post::with(['creator'])->where('created_by', Auth::user()->id)->orderBy('id','DESC')->get();
        }
        return view('admin.post.list',compact('data','page_name'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_name = 'Post Create';
        $categories = Category::where('status',1)->pluck('name','id');
        return view('admin.post.create',compact('page_name','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'img'=>'required',
        ]);

       $post = new Post();
       $post->title = $request->title;
       $post->slug = \Str::slug($request->title,'-');
       $post->short_description = $request->short_description;
       $post->description = $request->description;
       $post->category_id = $request->category_id;
       $post->status = 1;
       $post->hot_news = 0;
       $post->view_count = 0;
       $post->main_image = '';
       $post->thumb_image = '';
       $post->list_image = '';
       $post->created_by = Auth::id();
       $post->save();
       $file = $request->file('img');
       $extension = $file->getClientOriginalExtension();
       $main_image = 'post_main_'.$post->id.'.'.$extension;
       $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
       $list_image = 'post_list_'.$post->id.'.'.$extension;
       Image::make($file)->resize(653,569)->save(public_path('/post/'.$main_image));
       Image::make($file)->resize(360,309)->save(public_path('/post/'.$list_image));
       Image::make($file)->resize(122,122)->save(public_path('/post/'.$thumb_image));
       $post->main_image = $main_image;
       $post->thumb_image = $thumb_image;
       $post->list_image =  $list_image;
       $post->save();
       return redirect()->action('App\Http\Controllers\Admin\PostController@index')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_name = 'Post Edit';
        $post = Post::find($id);
        $categories = Category::where('status',1)->pluck('name','id');
        return view('admin.post.edit',compact('page_name','post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'category_id'=>'required',

          ]);

       $post = Post::find($id);
        if($request->file('img')){
            @unlink(public_path('/post/'.$post->$main_image));
            @unlink(public_path('/post/'.$post->$thumb_image));
            @unlink(public_path('/post/'.$post->$list_image));
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $main_image = 'post_main_'.$post->id.'.'.$extension;
            $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
            $list_image = 'post_list_'.$post->id.'.'.$extension;
            Image::make($file)->resize(653,569)->save(public_path('/post/'.$main_image));
            Image::make($file)->resize(360,309)->save(public_path('/post/'.$list_image));
            Image::make($file)->resize(122,122)->save(public_path('/post/'.$thumb_image));
            $post->main_image = $main_image;
            $post->thumb_image = $thumb_image;
            $post->list_image =  $list_image;
        }
        $post->title = $request->title;
        $post->slug = \Str::slug($request->title,'-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();
        return redirect()->action('App\Http\Controllers\Admin\PostController@index')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        @unlink(public_path('/post/'.$post->$main_image));
        @unlink(public_path('/post/'.$post->$thumb_image));
        @unlink(public_path('/post/'.$post->$list_image));
        $post->delete();
        return redirect()->action('App\Http\Controllers\Admin\PostController@index')->with('success','Post Deleted Successfully');
    }

    public function status(string $id)
    {
        $post = Post::find($id);
        if($post->status === 1){
            $post->status = 0;
        }else{
            $post->status = 1;
        }
        $post->save();
        return redirect()->action('App\Http\Controllers\Admin\PostController@index')->with('success', "Post Status Changed Successfully");
    }


    public function hot_news(string $id)
    {
        $post = Post::find($id);
        if ($post->hot_news === 1) {
             $post->hot_news = 0;
         }else{
              $post->hot_news = 1;
         }
           $post->save();
           return redirect()->action('App\Http\Controllers\Admin\PostController@index')->with('success','Post Set As Hot News Changed Successfully');
    }

     public function searchPost(Request $request){
        if ($request->search) {
            $searchPost = Post::where('title','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            return view('front.search', compact('searchPost'));
        } else {
            return redirect()->back()->with('message','Empty Search');
        }
    }
}
