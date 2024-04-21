<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    private static $size;
    private static $massage;

    public static function newSize($request)
    {
        self::$size = new Size();

        self::$size->name           = $request->name;
        self::$size->code           = $request->code;
        self::$size->description    = $request->description;
        self::$size->status         = $request->status;

        self::$size->save();
    }

    public static function sizeUpdate($request, $id)
    {
        self::$size = Size::find($id);

        self::$size->name           = $request->name;
        self::$size->description    = $request->description;
        self::$size->code           = $request->code;
        self::$size->status         = $request->status;

        self::$size->save();
    }

    public static function sizeStatus($id)
    {
        self::$size = Size::find($id);

        if (self::$size->status == 1)
        {
            self::$size->status = 0;
            self::$massage = 'Size Info Unpublished Successfully!';
        }
        else
        {
            self::$size->status = 1;
            self::$massage = 'Size Info Published Successfully!';
        }
        self::$size->save();
        return self::$massage;
    }
}
