<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'barcode',
        'description',
        'buy_price',
        'sell_price',
        'category_id',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function getImageAttribute($image)
    {
        return asset('/storage/products/'. $image);
    }
}
