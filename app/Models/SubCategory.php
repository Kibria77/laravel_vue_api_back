<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    private static $subCcategory;
    private static $image;
    private static $imageName;
    private static $directory;
    private static $imageUrl;
    private static $massage;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'sub-category/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;

        return self::$imageUrl;
    }

    public static function newSubCategory($request)
    {
        self::$subCcategory = new SubCategory();

        self::$subCcategory->category_id    = $request->category_id;
        self::$subCcategory->name           = $request->name;
        self::$subCcategory->description    = $request->description;
        self::$subCcategory->image          = self::getImageUrl($request);
        self::$subCcategory->status         = $request->status;

        self::$subCcategory->save();
    }

    public static function subCategoryUpdate($request, $id)
    {
        self::$subCcategory = SubCategory::find($id);

        self::$subCcategory->category_id    = $request->category_id;
        self::$subCcategory->name           = $request->name;
        self::$subCcategory->description    = $request->description;

        if (isset($request->image))
        {
            if (file_exists(self::$subCcategory->image))
            {
                unlink(self::$subCcategory->image);
            }
            self::$imageUrl  = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$subCcategory->image;
        }
        self::$subCcategory->image       = self::$imageUrl;

        self::$subCcategory->status      = $request->status;

        self::$subCcategory->save();
    }

    public static function updateSubCategoryStatus($id)
    {
        self::$subCcategory = SubCategory::find($id);

        if (self::$subCcategory->status == 1)
        {
            self::$subCcategory->status = 0;
            self::$massage = 'Category Info Unpublished Successfully!';
        }
        else
        {
            self::$subCcategory->status = 1;
            self::$massage = 'Category Info Published Successfully!';
        }
        self::$subCcategory->save();
        return self::$massage;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
