<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories_read')->only(['index']);
        $this->middleware('permission:categories_create')->only(['create','store']);
        $this->middleware('permission:categories_update')->only(['edit','update']);
        $this->middleware('permission:categories_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {

        $categories = Category::whenSearch($request->search)
            ->withCount('movies')
            ->paginate(5);
        return view('dashboard.categories.home',compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:categories,name',
        ]);

        Category::create($request->all());

        session()->flash('success','Data added successfully');
        return redirect()->route('dashboard.categories.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }


    public function update(Request $request, Category $category)
    {

        $request->validate([

            'name' => 'required|unique:categories,name,'. $category->id ,
        ]);

        $category->update($request->all());

        session()->flash('success','Data update successfully');
        return redirect()->route('dashboard.categories.index');

    }


    public function destroy(Category $category)
    {

        $category->delete();
        session()->flash('success','Data update successfully');
        return redirect()->route('dashboard.categories.index');
    }


}
