<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\OthersImage;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use DB;
use Nette\Schema\ValidationException;

class ProductController extends Controller
{
    protected $categoris;
    protected $categori;
    protected $subCategorys;
    protected $brands;
    protected $units;
    protected $sizes;
    protected $colors;
    protected $product;
    protected $products;
    protected $massage;

    public function index()
    {
        $this->categoris        = Category::where('status', 1)->get();
        $this->subCategorys     = SubCategory::where('status', 1)->get();
        $this->brands           = Brand::where('status', 1)->get();
        $this->units            = Unit::where('status', 1)->get();
        $this->sizes            = Size::where('status', 1)->get();
        $this->colors           = Color::where('status', 1)->get();
        return view('product.add-product', [
            'categoris'         => $this->categoris,
            'subCategorys'      => $this->subCategorys,
            'colors'            => $this->colors,
            'brands'            => $this->brands,
            'units'             => $this->units,
            'sizes'             => $this->sizes,
        ]);
    }

    public function getAllColorSize()
    {
        return response()->json([
            'sizes'   => Size::where('status', 1)->get(),
            'colors'  => Color::where('status', 1)->get(),
        ]);
    }

    public function getSubCategoryByCategory()
    {
        return response()->json(SubCategory::where('category_id', $_GET['id'])->get());
    }

    public function createProduct(Request $request)
    {
        $requestSize = $request->size;
        $requestColor = $request->color;
        $requestOtherImage = $request->other_images;

        DB::beginTransaction();
        try {
            $this->product = Product::newProduct($request);
            ProductSize::newProductSize($requestSize, $this->product->id);
            ProductColor::newProductColor($requestColor, $this->product->id);
            OthersImage::newOtherImages($requestOtherImage, $this->product->id);
        } catch (ValidationException $e) {
            DB::rollBack();;
            var_dump($e->getErrors());
        }
        DB::commit();
        return redirect()->back()->with('message', 'Product Create Successfully!');
    }

    public function manage()
    {
        $this->products = Product::orderBy('id', 'desc')->get(['id','category_id','brand_id','name','code','selling_price','image','status']);
        return view('product.manege', ['products' => $this->products]);
    }

    public function productStatusUpdate($id)
    {
        $this->massage = Product::updateProductStatus($id);
        return redirect()->back()->with($this->massage);
    }

    public function productDetails($id)
    {
        return view('product.detail', ['product' => Product::find($id)]);
    }

    public function productEdit($id)
    {
        return view('product.edit', [
            'product'          => Product::find($id),
            'categoris'        => Category::where('status', 1)->get(),
            'subCategorys'     => SubCategory::where('status', 1)->get(),
            'brands'           => Brand::where('status', 1)->get(),
            'units'            => Unit::where('status', 1)->get(),
            'sizes'            => Size::where('status', 1)->get(),
            'colors'           => Color::where('status', 1)->get(),
        ]);
    }

    public function productUpdate(Request $request, $id)
    {
        $requestSize = $request->size;
        $requestColor = $request->color;
        $requestOtherImage = $request->other_images;

        DB::beginTransaction();
        try {
            $this->product = Product::updateProduct($request, $id);
            ProductSize::updateProductSize($requestSize, $id);
            ProductColor::updateProductColor($requestColor, $id);
            OthersImage::updateOthersImage($requestOtherImage, $id);
        } catch (ValidationException $e) {
            DB::rollBack();;
            var_dump($e->getErrors());
        }
        DB::commit();

        return redirect('/manage-product')->with('message', 'Product Information Update Successfully!');
    }

    public function productDelete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Product::deleteProduct($id);
            ProductSize::where('product_id', $id)->delete();
            ProductColor::where('product_id', $id)->delete();
            OthersImage::deleteOthersImage($id);
        } catch (ValidationException $e) {
            DB::rollBack();;
            var_dump($e->getErrors());
        }
        DB::commit();

        return redirect('/manage-product')->with('massage', 'Product Delete Successfully!');
    }
}
