<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategorys;
    protected $subCategory;
    protected $categoris;

    public function index()
    {
        $this->subCategorys = SubCategory::all();
        $this->categoris    = Category::where('status', 1)->get();
        return view('sub-category.manage', ['subCategorys' => $this->subCategorys, 'categoris' => $this->categoris]);
    }

    public function store(Request $request)
    {
        SubCategory::newSubCategory($request);
        return redirect()->back()->with(['massage' => 'Sub-Category Create Successfully!']);
    }

    public function edit(Request $request, $id)
    {
        $this->categoris    = Category::where('status', 1)->get();
        $this->subCategorys = SubCategory::all();
        $this->subCategory = SubCategory::find($id);
        return view('sub-category.edit', ['subCategory' => $this->subCategory, 'subCategorys' => $this->subCategorys, 'categoris' => $this->categoris]);
    }

    public function update($id)
    {
        SubCategory::updateSubCategoryStatus($id);
        return redirect()->back()->with(['massage' => 'Sub-Category Status Update Successfully!']);
    }

    public function updateSubCategory(Request $request, $id)
    {
        SubCategory::subCategoryUpdate($request, $id);
        return redirect('/subCategory-index')->with(['massage' => 'Sub-Category Info Update Successfully!']);
    }

    public function destroy($id)
    {
        $this->subCategory = SubCategory::find($id);
        if (file_exists($this->subCategory->image))
        {
            unlink($this->subCategory->image);
        }
        $this->subCategory->delete();

        return redirect('/subCategory-index')->with('massage', 'Sub-Category Delete Successfully!');
    }
}
