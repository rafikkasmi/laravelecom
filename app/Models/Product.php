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
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function it()
    {
        return $this->belongsTo(User::class,'it_id');
    }
}
