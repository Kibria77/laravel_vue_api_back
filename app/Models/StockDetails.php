<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    use HasFactory;

    public function suplier()
    {
        return $this->belongsTo('App\Models\Suplier');
    }
    public function supliers()
    {
        return $this->hasMany('App\Models\Suplier');
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
