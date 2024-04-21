<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brands;
    protected $brand;
    protected $massage;

    public function index()
    {
        $this->brands = Brand::orderBy('id', 'desc')->get();
        return view('brand.manage', ['brands' => $this->brands]);
    }

    public function store(Request $request)
    {
        Brand::newCategory($request);
        $this->brands = Brand::orderBy('id', 'desc')->get();
        return redirect()->back()->with(['massage' => 'New Brand Create Successfully!', 'brands' => $this->brands]);
    }

    public function updateBrandStatus($id)
    {
        $this->massage = Brand::publicCategoryStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editBrandInfo($id)
    {
        $this->brands = Brand::all();
        $this->brand  = Brand::find($id);
        return view('brand.edit', ['brand' => $this->brand, 'brands' => $this->brands]);
    }

    public function brandInfoUpdate(Request $request, $id)
    {
        Brand::categoryUpdate($request, $id);
        return redirect('/brand-index')->with('massage', 'Brand Info Update Successfully!');
    }

    public function brandDelete($id)
    {
        $this->brand = Brand::find($id);
        if (file_exists($this->brand->image))
        {
            unlink($this->brand->image);
        }
        $this->brand->delete();

        return redirect('/brand-index')->with('massage', 'Brand Delete Successfully!');
    }
}
