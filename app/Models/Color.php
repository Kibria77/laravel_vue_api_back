<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    private static $color;
    private static $massage;

    public static function newColor($request)
    {
        self::$color = new Color();

        self::$color->name           = $request->name;
        self::$color->code           = $request->code;
        self::$color->description    = $request->description;
        self::$color->status         = $request->status;

        self::$color->save();
    }

    public static function colorUpdate($request, $id)
    {
        self::$color = Color::find($id);

        self::$color->name           = $request->name;
        self::$color->description    = $request->description;
        self::$color->code           = $request->code;
        self::$color->status         = $request->status;

        self::$color->save();
    }

    public static function colorStatus($id)
    {
        self::$color = Color::find($id);

        if (self::$color->status == 1)
        {
            self::$color->status = 0;
            self::$massage = 'Color Info Unpublished Successfully!';
        }
        else
        {
            self::$color->status = 1;
            self::$massage = 'Color Info Published Successfully!';
        }
        self::$color->save();
        return self::$massage;
    }
}
