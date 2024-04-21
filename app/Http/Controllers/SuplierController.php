<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    protected $suplier;
    protected $supliers;
    protected $massage;

    public function index()
    {
        $this->supliers = Suplier::orderBy('id', 'desc')->get();
        return view('suplier.manege', ['supliers' => $this->supliers]);
    }

    public function store(Request $request)
    {
        Suplier::newSuplier($request);

        return redirect()->back()->with(['massage' => 'New Suplier Create Successfully!', 'supliers' => $this->supliers]);
    }

    public function updateSuplierStatus($id)
    {
        $this->massage = Suplier::publicSuplierStatus($id);
        return redirect()->back()->with(['massage' => $this->massage]);
    }

    public function editSuplierInfo($id)
    {
        $this->supliers = Suplier::all();
        $this->suplier= Suplier::find($id);
        return view('suplier.edit', ['suplier' => $this->suplier, 'supliers' => $this->supliers]);
    }

    public function SuplierInfoUpdate(Request $request, $id)
    {
        Suplier::suplierUpdate($request, $id);
        return redirect('/suplier-index')->with('massage', 'Suplier Info Update Successfully!');
    }

    public function suplierDelete(Request $request, $id)
    {
        Suplier::suplierTrust($id);
        return redirect('/suplier-index')->with('massage', 'Suplier Delete Successfully!');
    }
}
