<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OthersImage;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    private $result = [];
    private $categoris;
    private $products;
    private $images;
    private $popularProducts;
    private $bestSellsProducts;
    private $featureProducts;
    private $specialProducts;

    public function getAllCategory()
    {
        $this->categoris = Category::where('status', 1)->get();
        foreach ($this->categoris as $key => $category)
        {
            $this->result[$key]['categori'] = $category;
            $this->result[$key]['sub_categoris'] = SubCategory::where('category_id', $category->id)->get();
        }
        return response()->json($this->result);
    }

    public function getAllRecentProduct()
    {
        $this->products = Product::where('status', 1)->orderBy('id', 'desc')->take(6)->get(['id', 'name', 'image', 'selling_price']);
        foreach ($this->products as $product)
        {
            $this->images = asset($product->image);
            $product->image = $this->images;
            $product->image2 = isset(OthersImage::where('product_id', $product->id)->first()->image) ? asset(OthersImage::where('product_id', $product->id)->first()->image) : $this->images;
        }
        return response()->json($this->products);
    }

    public function getAllTradingProduct()
    {
        $this->popularProducts = Product::where('status', 1)->orderBy('hit_count', 'desc')->take(8)->get(['id', 'hit_count', 'name', 'image', 'selling_price']);
        foreach ($this->popularProducts as $popularProduct)
        {
            $popularProduct->name       = substr($popularProduct->name, 0, 50);
            $popularProduct->image      = asset($popularProduct->image);
            $popularProduct->image2     = isset(OthersImage::where('product_id', $popularProduct->id)->first()->image) ? asset(OthersImage::where('product_id', $popularProduct->id)->first()->image) : $popularProduct->image;
        }

        $this->bestSellsProducts = Product::where('status', 1)->orderBy('sales_count', 'desc')->take(8)->get(['id', 'sales_count', 'name', 'image', 'selling_price']);
        foreach ($this->bestSellsProducts as $bestSellsProduct)
        {
            $bestSellsProduct->name       = substr($bestSellsProduct->name, 0, 50);
            $bestSellsProduct->image      = asset($bestSellsProduct->image);
            $bestSellsProduct->image2     = isset(OthersImage::where('product_id', $bestSellsProduct->id)->first()->image) ? asset(OthersImage::where('product_id', $bestSellsProduct->id)->first()->image) : $bestSellsProduct->image;
        }

        $this->featureProducts = Product::where(['status' => 1, 'feature_status' => 1])->orderBy('id', 'desc')->take(8)->get(['id', 'name', 'image', 'selling_price']);
        foreach ($this->featureProducts as $featureProduct)
        {
            $featureProduct->name       = substr($featureProduct->name, 0, 50);
            $featureProduct->image      = asset($featureProduct->image);
            $featureProduct->image2     = isset(OthersImage::where('product_id', $featureProduct->id)->first()->image) ? asset(OthersImage::where('product_id', $featureProduct->id)->first()->image) : $featureProduct->image;
        }

        $this->specialProducts = Product::where(['status' => 1, 'feature_status' => 1])->orderBy('id', 'desc')->take(8)->get(['id', 'name', 'image', 'selling_price']);
        foreach ($this->specialProducts as $specialProduct)
        {
            $specialProduct->name       = substr($specialProduct->name, 0, 50);
            $specialProduct->image      = asset($specialProduct->image);
            $specialProduct->image2     = isset(OthersImage::where('product_id', $specialProduct->id)->first()->image) ? asset(OthersImage::where('product_id', $specialProduct->id)->first()->image) : $specialProduct->image;
        }

        return response()->json([
            0 => [
                'name'      => 'Popular Product',
                'products'   => $this->popularProducts,
            ],
            1 => [
                'name'      => 'Best Sales Product',
                'products'   => $this->bestSellsProducts,
            ],
            2 => [
                'name'      => 'Feature Product',
                'products'   => $this->featureProducts,
            ],
            3 => [
                'name'      => 'Special Product',
                'products'   => $this->specialProducts,
            ],
        ]);
    }
}
