<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected static $productColor;

    public static function newProductColor($requestColor, $productId)
    {
        foreach ($requestColor as $color) {
            self::$productColor = new ProductColor();
            self::$productColor->product_id = $productId;
            self::$productColor->color_id = $color;
            self::$productColor->save();
        }

    }

    public static function updateProductColor($requestColor, $productId)
    {
        ProductColor::where('product_id', $productId)->delete();
        self::newProductColor($requestColor, $productId);
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
}
