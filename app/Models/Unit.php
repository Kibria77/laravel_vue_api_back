<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    private static $unit;
    private static $massage;

    public static function newUnit($request)
    {
        self::$unit = new Unit();

        self::$unit->name           = $request->name;
        self::$unit->code           = $request->code;
        self::$unit->description    = $request->description;
        self::$unit->status         = $request->status;

        self::$unit->save();
    }

    public static function unitUpdate($request, $id)
    {
        self::$unit = Unit::find($id);

        self::$unit->name           = $request->name;
        self::$unit->description    = $request->description;
        self::$unit->code           = $request->code;
        self::$unit->status         = $request->status;

        self::$unit->save();
    }

    public static function unitStatus($id)
    {
        self::$unit = Unit::find($id);

        if (self::$unit->status == 1)
        {
            self::$unit->status = 0;
            self::$massage = 'Unit Info Unpublished Successfully!';
        }
        else
        {
            self::$unit->status = 1;
            self::$massage = 'Unit Info Published Successfully!';
        }
        self::$unit->save();
        return self::$massage;
    }
}
