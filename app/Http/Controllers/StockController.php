<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Stock;
use App\Models\StockDetails;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    private $id;
    private $sizeData;
    private $sizeArray = [];
    private $colorData;
    private $colorArray = [];
    private $resultArray = [];
    private $temptArray = [];
    private $index;
    private $stock;
    private $stockDetails;
    private $stockDetail = [];

    public function index()
    {
        return view('stock.add', [
            'supliers'      =>   Suplier::where('status', 1)->get(),
            'products'      =>   Product::where('status', 1)->get(),
            'colors'        =>   Color::where('status', 1)->get(),
            'sizes'         =>   Size::where('status', 1)->get(),
        ]);
    }

    public function getDataIdWish()
    {
        return response()->json([
            'supliers'      =>   Suplier::where('status', 1)->get(),
            'products'      =>   Product::where('status', 1)->get(),
            'colors'        =>   Color::where('status', 1)->get(),
            'sizes'         =>   Size::where('status', 1)->get(),
        ]);
    }

    public function getProductStockInfo()
    {
        $this->id = $_GET['id'];

        $this->sizeData = ProductSize::where('product_id', $this->id)->get();
        foreach ($this->sizeData as $key => $value)
        {
            $this->sizeArray[$key]['id'] = $value->size_id;
            $this->sizeArray[$key]['name'] = Size::find($value->size_id)->name;
        }

        $this->colorData = ProductColor::where('product_id', $this->id)->get();
        foreach ($this->colorData as $key => $value)
        {
            $this->colorArray[$key]['id'] = $value->color_id;
            $this->colorArray[$key]['name'] = Color::find($value->color_id)->name;
        }

        return response()->json([
            'sizes' => $this->sizeArray,
            'colors' => $this->colorArray,
            'price' => Product::find($this->id)->selling_price,
        ]);
    }

    public function store(Request $request)
    {
        $this->index = 0;
        foreach ($request->stock as $item)
        {
            foreach ($item['size'] as $value)
            {
                foreach ($item['color'] as $colorValue)
                {
                    $this->resultArray[$this->index]['suplier'] = $item['suplier'];
                    $this->resultArray[$this->index]['product'] = $item['product'];
                    $this->resultArray[$this->index]['size'] = $value;
                    $this->resultArray[$this->index]['color'] = $colorValue;
                    $this->resultArray[$this->index]['unit_price'] = $item['unit_price'];
                    $this->resultArray[$this->index]['stock_amount'] = $item['stock_amount'];
                    $this->index++;
                }
            }
        }

        $this->stock = new Stock();
        $this->stock->stock_date        = $request->stock_date;
        $this->stock->stock_timestamp   = strtotime($request->stock_date);
        $this->stock->chalan_no            = $request->chalan_no;
        $this->stock->created_by        = Auth::user()->id;
        $this->stock->save();

        foreach ($this->resultArray as $v_arrey) {
            $this->stockDetails = new StockDetails();
            $this->stockDetails->stock_id       = $this->stock->id;
            $this->stockDetails->suplier        = $v_arrey['suplier'];
            $this->stockDetails->product        = $v_arrey['product'];
            $this->stockDetails->size           = $v_arrey['size'];
            $this->stockDetails->color          = $v_arrey['color'];
            $this->stockDetails->unit_price     = $v_arrey['unit_price'];
            $this->stockDetails->stock_amount   = $v_arrey['stock_amount'];
            $this->stockDetails->save();

        }

        return redirect()->back()->with('massage', 'New Inventory Created Successfully!');
    }

    public function manage()
    {
        return view('stock.manage', ['stocks' => Stock::orderBy('id', 'desc')->get()]);
    }

    public function detail($id)
    {
        return view('stock.detail', ['stock' => Stock::find($id)]);
    }

    public function edit($id)
    {
        return view('stock.edit', [
            'stockdd' => Stock::find($id),
            'supliers'      =>   Suplier::where('status', 1)->get(),
            'products'      =>   Product::where('status', 1)->get(),
            'colors'        =>   Color::where('status', 1)->get(),
            'sizes'         =>   Size::where('status', 1)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->stock = Stock::find($id);

        $this->stock->stock_date        = $request->stock_date;
        $this->stock->stock_timestamp   = strtotime($request->stock_date);
        $this->stock->chalan_no            = $request->chalan_no;
        $this->stock->updated_by        = Auth::user()->id;
        $this->stock->save();

        $this->stockDetail = StockDetails::where('stock_id', $id)->get();
        foreach ($this->stockDetail as $item)
        {
            $item->delete();
        }

        $this->index = 0;
        foreach ($request->stock as $item)
        {
            foreach ($item['size'] as $value)
            {
                foreach ($item['color'] as $colorValue)
                {
                    $this->resultArray[$this->index]['suplier'] = $item['suplier'];
                    $this->resultArray[$this->index]['product'] = $item['product'];
                    $this->resultArray[$this->index]['size'] = $value;
                    $this->resultArray[$this->index]['color'] = $colorValue;
                    $this->resultArray[$this->index]['unit_price'] = $item['unit_price'];
                    $this->resultArray[$this->index]['stock_amount'] = $item['stock_amount'];
                    $this->index++;
                }
            }
        }

        foreach ($this->resultArray as $v_arrey) {
            $this->stockDetails = new StockDetails();
            $this->stockDetails->stock_id       = $this->stock->id;
            $this->stockDetails->suplier        = $v_arrey['suplier'];
            $this->stockDetails->product        = $v_arrey['product'];
            $this->stockDetails->size           = $v_arrey['size'];
            $this->stockDetails->color          = $v_arrey['color'];
            $this->stockDetails->unit_price     = $v_arrey['unit_price'];
            $this->stockDetails->stock_amount   = $v_arrey['stock_amount'];
            $this->stockDetails->save();

        }

        return redirect('/stock-manage')->with('massage', 'Inventory Update Successfully!');
    }
}
