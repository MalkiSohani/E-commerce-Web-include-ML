<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = ['user', 'product', 'rating', 'comment'];

    public function userdata()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
