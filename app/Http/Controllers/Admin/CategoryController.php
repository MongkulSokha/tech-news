<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_name = 'Categories';
        $data = Category::all();
        return view('admin.category.list',compact('page_name','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_name = 'Category Create';
        return view('admin.category.create',compact('page_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
            'name'=>'required'
        ]);

        $category = new Category();
        $category->name = $request->name; 
        $category->status = 1;
        $category->save();
        return redirect()->action('App\Http\Controllers\Admin\CategoryController@index')->with('success', "Category Created Successfully");
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
        $page_name = 'Category Edit';
        $category = Category::find($id);
        return view('admin.category.edit', compact('category', 'page_name'));
    }
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [ 
            'name'=>'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name; 
        $category->status = 1;
        $category->save();
        return redirect()->action('App\Http\Controllers\Admin\CategoryController@index')->with('success', "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete(); 
        return redirect()->action('App\Http\Controllers\Admin\CategoryController@index')->with('success', "Category Deleted Successfully");
    }

    public function status(string $id)
    {
        $category = Category::find($id);
        if($category->status === 1){
            $category->status = 0;
        }else{
            $category->status = 1;
        }
        $category->save();
        return redirect()->action('App\Http\Controllers\Admin\CategoryController@index')->with('success', "Category Status Changed Successfully");
    }
}
