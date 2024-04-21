<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OthersImage extends Model
{
    use HasFactory;

    protected static $otherImage;
    protected static $image;
    protected static $imageName;
    protected static $directory;
    protected static $imageUrl;

    public static function newOtherImages($requestOtherImage, $productId)
    {
        foreach ($requestOtherImage as $image) {
            self::$imageName    =  $image->getClientOriginalName($image);
            self::$directory    = 'product-other-image/';
            $image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;

            self::$otherImage = new OthersImage();
            self::$otherImage->product_id = $productId;

            self::$otherImage->image = self::$imageUrl;
            self::$otherImage->save();
        }

    }

    public static function updateOthersImage($requestOtherImage, $productId)
    {
        if ($requestOtherImage)
        {
            OthersImage::where('product_id', $productId)->delete();
            self::newOtherImages($requestOtherImage, $productId);
        }
    }

    public static function deleteOthersImage($id)
    {
        self::$otherImage = OthersImage::where('product_id', $id)->get();
        foreach (self::$otherImage as $image)
        {
            if (file_exists($image->image))
            {
                unlink($image->image);
            }
            $image->delete();
        }
    }
}
