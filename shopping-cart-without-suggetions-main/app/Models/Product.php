<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['formatPrice', 'subOfRating'];

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Deleted'];

    protected $fillable = ['shop', 'img', 'rfid', 'name', 'description', 'qty', 'price', 'status', 'is_fridge_item'];

    public static function getData($getActiveOnly = false)
    {
        $query = self::whereIn('status', ($getActiveOnly) ? [1] : [1, 2]);
        if (Auth::user() && Auth::user()->usertype == 2) {
            $query->whereIn('shop', Shop::getData(true)->pluck('id')->toArray());
        }
        return $query;
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset('assets/img/products/' . $value),
        );
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'product', 'id')->selectRaw('avg(rating) as rate, product')
            ->groupBy('product');
    }

    public function getFormatPriceAttribute()
    {
        return format_currency($this->attributes['price']);
    }

    public function getSubOfRatingAttribute()
    {
        return format_currency($this->attributes['price']);
    }

    public function ratedata()
    {
        return $this->hasMany(Ratings::class, 'product', 'id')->with('userdata');
    }
}
