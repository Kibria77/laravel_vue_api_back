<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoris;
    protected $category;
    protected $massage;

    public function index()
    {
        $this->categoris = Category::orderBy('id', 'desc')->get();
        return view('category.manage', ['categoris' => $this->categoris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::newCategory($request);

        return redirect()->back()->with(['massage' => 'New Category Create Successfully!', 'categoris' => $this->categoris]);
    }

    public function updateCategoryStatus($id)
    {
        $this->massage = Category::publicCategoryStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editCategoryInfo($id)
    {
        $this->categoris = Category::all();
        $this->category = Category::find($id);
        return view('category.edit', ['category' => $this->category, 'categoris' => $this->categoris]);
    }

    public function categoryInfoUpdate(Request $request, $id)
    {
        Category::categoryUpdate($request, $id);
        return redirect('/category-index')->with('massage', 'Category Info Update Successfully!');
    }

    public function categoryDelete($id)
    {
        $this->category = Category::find($id);
        if (file_exists($this->category->image))
        {
            unlink($this->category->image);
        }
        $this->category->delete();

        return redirect('/category-index')->with('massage', 'Category Delete Successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
