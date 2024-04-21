<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static $image;
    protected static $imageName;
    protected static $directory;
    protected static $imageUrl;
    protected static $product;
    protected static $massage;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'product-image/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;

        return self::$imageUrl;
    }

    public static function newProduct($request)
    {
        self::$product = new Product();

        self::$product->category_id         = $request->category_id;
        self::$product->sub_category_id     = $request->sub_category_id;
        self::$product->brand_id            = $request->brand_id;
        self::$product->unit_id             = $request->unit_id;
        self::$product->name                = $request->name;
        self::$product->code                = $request->code;
        self::$product->model               = $request->model;
        self::$product->regular_price       = $request->regular_price;
        self::$product->selling_price       = $request->selling_price;
        self::$product->meta_tag            = $request->meta_tag;
        self::$product->meta_description    = $request->meta_description;
        self::$product->short_description   = $request->short_description;
        self::$product->long_description    = $request->long_description;
        self::$product->status              = $request->status;
        self::$product->image               = self::getImageUrl($request);

        self::$product->save();

        return self::$product;
    }

    public static function updateProductStatus($id)
    {
        self::$product = Product::find($id);
        if (self::$product->status == 1)
        {
            self::$product->status = 0;
            self::$massage = 'Product Unpublished Successfully!';
        }
        else
        {
            self::$product->status = 1;
            self::$massage = 'Product Published Successfully!';
        }
        self::$product->save();

        return self::$massage;
    }

    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);

        self::$product->category_id         = $request->category_id;
        self::$product->sub_category_id     = $request->sub_category_id;
        self::$product->brand_id            = $request->brand_id;
        self::$product->unit_id             = $request->unit_id;
        self::$product->name                = $request->name;
        self::$product->code                = $request->code;
        self::$product->model               = $request->model;
        self::$product->regular_price       = $request->regular_price;
        self::$product->selling_price       = $request->selling_price;
        self::$product->meta_tag            = $request->meta_tag;
        self::$product->meta_description    = $request->meta_description;
        self::$product->short_description   = $request->short_description;
        self::$product->long_description    = $request->long_description;
        self::$product->status              = $request->status;
        if (isset($request->image))
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$imageUrl  = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }
        self::$product->image       = self::$imageUrl;

        self::$product->save();

        return self::$product;
    }

    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);
        if (file_exists(self::$product->image))
        {
            unlink(self::$product->image);
        }
        self::$product->delete();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function colors()
    {
        return $this->hasMany('App\Models\ProductColor');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\ProductSize');
    }

    public function othersImages()
    {
        return $this->hasMany('App\Models\OthersImage');
    }
}
