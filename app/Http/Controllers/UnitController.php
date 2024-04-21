<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $units;
    protected $unit;
    protected $massage;

    public function index()
    {
        $this->units = Unit::orderBy('id', 'desc')->get();
        return view('unit.manage', ['units' => $this->units]);
    }

    public function store(Request $request)
    {
        Unit::newUnit($request);
        $this->units = Unit::orderBy('id', 'desc')->get();
        return redirect()->back()->with(['massage' => 'New Color Create Successfully!', 'units' => $this->units]);
    }

    public function updateUnitStatus($id)
    {
        $this->massage = Unit::unitStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editUnitInfo($id)
    {
        $this->units = Unit::all();
        $this->unit  = Unit::find($id);
        return view('unit.edit', ['unit' => $this->unit, 'units' => $this->units]);
    }

    public function unitInfoUpdate(Request $request, $id)
    {
        Unit::unitUpdate($request, $id);
        return redirect('/unit-index')->with('massage', 'Unit Info Update Successfully!');
    }

    public function unitDelete($id)
    {
        $this->unit = Unit::find($id);
        $this->unit->delete();

        return redirect('/unit-index')->with('massage', 'Unit Delete Successfully!');
    }
}
