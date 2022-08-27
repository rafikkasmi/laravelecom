<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'it_id',
        'category_id',
        'stock',
        'discount_price'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function it()
    {
        return $this->belongsTo(User::class,'it_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }
}
