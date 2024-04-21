<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colors;
    protected $color;
    protected $massage;

    public function index()
    {
        $this->colors = Color::orderBy('id', 'desc')->get();
        return view('color.manage', ['colors' => $this->colors]);
    }

    public function store(Request $request)
    {
        Color::newColor($request);
        $this->colors = Color::orderBy('id', 'desc')->get();
        return redirect()->back()->with(['massage' => 'New Color Create Successfully!', 'colors' => $this->colors]);
    }

    public function updateColorStatus($id)
    {
        $this->massage = Color::colorStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editColorInfo($id)
    {
        $this->colors = Color::all();
        $this->color  = Color::find($id);
        return view('color.edit', ['color' => $this->color, 'colors' => $this->colors]);
    }

    public function colorInfoUpdate(Request $request, $id)
    {
        Color::colorUpdate($request, $id);
        return redirect('/color-index')->with('massage', 'Color Info Update Successfully!');
    }

    public function colorDelete($id)
    {
        $this->color = Color::find($id);
        $this->color->delete();

        return redirect('/color-index')->with('massage', 'Color Delete Successfully!');
    }
}
