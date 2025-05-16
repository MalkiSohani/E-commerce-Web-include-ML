<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Deleted'];

    protected $fillable = ['owner', 'name', 'address', 'tel', 'lng', 'ltd', 'status'];

    public static function getData($getActiveOnly = false)
    {
        $query = self::whereIn('status', ($getActiveOnly) ? [1] : [1, 2]);
        if (Auth::user() && Auth::user()->usertype == 2) {
            $query->whereIn('owner', Auth::user()->id);
        }
        return $query;
    }

    public function ownerdata()
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }
}
