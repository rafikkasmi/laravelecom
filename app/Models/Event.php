<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Event extends Model
{
    use HasFactory;

    const PENDING = 1;
    const REFUSED = 2;
    const ACCEPTED = 3;

    protected $fillable = [
        'name',
        'image',
        'description',
        'it_id',
        'status',
     ];

     public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    
    public function it()
    {
        return $this->belongsTo(User::class,'it_id');
    }
}
