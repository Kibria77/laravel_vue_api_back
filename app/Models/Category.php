<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    private static $category;
    private static $image;
    private static $imageName;
    private static $directory;
    private static $imageUrl;
    private static $massage;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'category/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;

        return self::$imageUrl;
    }

    public static function newCategory($request)
    {
        self::$category = new Category();

        self::$category->name           = $request->name;
        self::$category->description    = $request->description;
        self::$category->image          = self::getImageUrl($request);
        self::$category->status         = $request->status;

        self::$category->save();
    }

    public static function categoryUpdate($request, $id)
    {
        self::$category = Category::find($id);

        self::$category->name           = $request->name;
        self::$category->description    = $request->description;

        if (isset($request->image))
        {
            if (file_exists(self::$category->image))
            {
                unlink(self::$category->image);
            }
            self::$imageUrl  = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$category->image;
        }
        self::$category->image       = self::$imageUrl;

        self::$category->status      = $request->status;

        self::$category->save();
    }

    public static function publicCategoryStatus($id)
    {
        self::$category = Category::find($id);

        if (self::$category->status == 1)
        {
            self::$category->status = 0;
            self::$massage = 'Category Info Unpublished Successfully!';
        }
        else
        {
            self::$category->status = 1;
            self::$massage = 'Category Info Published Successfully!';
        }
        self::$category->save();
        return self::$massage;
    }
}
