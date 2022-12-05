<?php

namespace App\Http\Controllers;

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
        $cate = Category::orderby('name', 'asc')->get();
        return view('admin.category', ['categories'=> $cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(isset($_GET['rd']) && $_GET['rd'] == 'post'){
            $_SESSION['rd'] = true;
        }
        return view('admin.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request->name);
        $this->validate($request, [
            'name' => ['required'],
            'desc' => ['required']
        ]);

        $result = Category::create([
            'name' => ucwords($request->name),
            'description' => $request->desc,

        ]);

        $request->session()->flash('message', 'New Category Created Successfully');
        $request->session()->flash('alert-class', 'alert-success');
        

            return redirect('/dash/categories/index');

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {

       $result = $category->delete();
        if($result == true){
            $request->session()->flash('message', 'Category Deleted successfully!');
            $request->session()->flash('alert-class', 'alert-success');
        }else{
            $request->session()->flash('message', 'Category not deleted, please retry!');
            $request->session()->flash('alert-class', 'alert-danger');
        }
    
        return redirect('/dash/categories/index');

    }
}
