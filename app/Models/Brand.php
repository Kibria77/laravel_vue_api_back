<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    private static $brand;
    private static $image;
    private static $imageName;
    private static $directory;
    private static $imageUrl;
    private static $massage;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'brand-image/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;

        return self::$imageUrl;
    }

    public static function newCategory($request)
    {
        self::$brand = new Brand();

        self::$brand->name           = $request->name;
        self::$brand->description    = $request->description;
        self::$brand->image          = self::getImageUrl($request);
        self::$brand->status         = $request->status;

        self::$brand->save();
    }

    public static function categoryUpdate($request, $id)
    {
        self::$brand = Brand::find($id);

        self::$brand->name           = $request->name;
        self::$brand->description    = $request->description;

        if (isset($request->image))
        {
            if (file_exists(self::$brand->image))
            {
                unlink(self::$brand->image);
            }
            self::$imageUrl  = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$brand->image;
        }
        self::$brand->image       = self::$imageUrl;

        self::$brand->status      = $request->status;

        self::$brand->save();
    }

    public static function publicCategoryStatus($id)
    {
        self::$brand = Brand::find($id);

        if (self::$brand->status == 1)
        {
            self::$brand->status = 0;
            self::$massage = 'Category Info Unpublished Successfully!';
        }
        else
        {
            self::$brand->status = 1;
            self::$massage = 'Category Info Published Successfully!';
        }
        self::$brand->save();
        return self::$massage;
    }
}
