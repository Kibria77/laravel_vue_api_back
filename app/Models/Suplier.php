<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\fileExists;

class Suplier extends Model
{
    use HasFactory;

    protected static $suplier;
    protected static $supliers;
    protected static $image;
    protected static $imageName;
    protected static $directory;
    protected static $imageUrl;
    protected static $massage;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('logo');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'suplier/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;

        return self::$imageUrl;
    }

    public static function newSuplier($request)
    {
        self::$suplier = new Suplier();

        self::$suplier->company_name            = $request->company_name;
        self::$suplier->person_name             = $request->person_name;
        self::$suplier->code                    = $request->code;
        self::$suplier->mobile                  = $request->mobile;
        self::$suplier->email                   = $request->email;
        self::$suplier->logo                    = self::getImageUrl($request);
        self::$suplier->address                 = $request->address;
        self::$suplier->account_number          = $request->account_number;
        self::$suplier->status                  = $request->status;

        self::$suplier->save();
    }

    public static function suplierUpdate($request, $id)
    {
        self::$suplier = Suplier::find($id);

        self::$suplier->company_name            = $request->company_name;
        self::$suplier->person_name             = $request->person_name;
        self::$suplier->code                    = $request->code;
        self::$suplier->mobile                  = $request->mobile;
        self::$suplier->email                   = $request->email;

        if (isset($request->logo))
        {
            if (file_exists(self::$suplier->logo))
            {
                unlink(self::$suplier->logo);
            }
            self::$imageUrl  = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$suplier->logo;
        }
        self::$suplier->logo       = self::$imageUrl;

        self::$suplier->address                 = $request->address;
        self::$suplier->account_number          = $request->account_number;
        self::$suplier->status                  = $request->status;

        self::$suplier->save();
    }

    public static function publicSuplierStatus($id)
    {
        self::$suplier = Suplier::find($id);

        if (self::$suplier->status == 1)
        {
            self::$suplier->status = 0;
            self::$massage = 'Suplier Info Unpublished Successfully!';
        }
        else
        {
            self::$suplier->status = 1;
            self::$massage = 'Suplier Info Published Successfully!';
        }
        self::$suplier->save();
        return self::$massage;
    }

    public static function suplierTrust($id)
    {
        self::$suplier = Suplier::find($id);

        if (fileExists(self::$suplier->logo))
        {
            unlink(self::$suplier->logo);
        }
        self::$suplier->delete();
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
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
}
