<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate();
        
        return response()->json($categories, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        
        $category = new Category();
        $category->name = $request->name;

        $path = $request->file('image')->store('categories');

        $category->image = $path;
        
        if($category->save()){
            return response()->json($category, 200);
        }
        return response()->json($category, 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $path = null;
        $request->validate(['name'  => 'required|min:3']);

        $category->name = $request->name;
        $oldPath = $category->image;

        if($request->hasFile('image')){

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg'
            ]);
            
            $path = $request->file('image')->store('categories');
            $category->image = $path;
            Storage::delete($oldPath);
        }

        if($category->save()){
            return response()->json($category, 200);
        }else{
            Storage::delete($path);
            return response()->json([
                'message' => 'Some error occured, please try again.',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            Storage::delete($category->image);
            return response()->json([
                'message' => 'Category deleted successfully',
                'status_code' => 200
            ], 200);
        }else{
            return response()->json([
                'message' => 'Some error occured, please try again.',
                'status_code' => 500
            ], 500);
        }
    }
}
