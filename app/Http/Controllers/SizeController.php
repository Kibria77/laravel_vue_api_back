<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizes;
    protected $size;
    protected $massage;

    public function index()
    {
        $this->sizes = Size::orderBy('id', 'desc')->get();
        return view('size.manage', ['sizes' => $this->sizes]);
    }

    public function store(Request $request)
    {
        Size::newSize($request);
        $this->sizes = Size::orderBy('id', 'desc')->get();
        return redirect()->back()->with(['massage' => 'New Color Create Successfully!', 'sizes' => $this->sizes]);
    }

    public function updateSizeStatus($id)
    {
        $this->massage = Size::sizeStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editSizeInfo($id)
    {
        $this->sizes = Size::all();
        $this->size  = Size::find($id);
        return view('size.edit', ['size' => $this->size, 'sizes' => $this->sizes]);
    }

    public function sizeInfoUpdate(Request $request, $id)
    {
        Size::sizeUpdate($request, $id);
        return redirect('/size-index')->with('massage', 'Size Info Update Successfully!');
    }

    public function sizeDelete($id)
    {
        $this->size = Size::find($id);
        $this->size->delete();

        return redirect('/size-index')->with('massage', 'Size Delete Successfully!');
    }
}
