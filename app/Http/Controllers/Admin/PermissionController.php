<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_name = 'Permission';
        $data = Permission::all();
        return view('admin.permission.list',compact('data', 'page_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
            'name'=>'required|alpha_num'
        ], [ 
            'name.required'=>"Name Field is Required",
            'name.alpha_num'=>"Name field accepts alpha numeric characters",
        ]);

        $permission = new Permission();
        $permission->name = $request->name; 
        $permission->display_name = $request->display_name; 
        $permission->description = $request->description; 
        $permission->save();
        return redirect()->action('App\Http\Controllers\Admin\PermissionController@index')->with('success', "Permission Created Successfully");
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
        $page_name = 'Permission Edit';
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission', 'page_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [ 
            'name'=>'required|alpha_num'
        ], [ 
            'name.required'=>"Name Field is Required",
            'name.alpha_num'=>"Name field accepts alpha numeric characters",
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->name; 
        $permission->display_name = $request->display_name; 
        $permission->description = $request->description; 
        $permission->save();
        return redirect()->action('App\Http\Controllers\Admin\PermissionController@index')->with('success', "Permission Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete(); 
        return redirect()->action('App\Http\Controllers\Admin\PermissionController@index')->with('success', "Permission Deleted Successfully");
    }
}
