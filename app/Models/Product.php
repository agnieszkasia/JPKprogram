<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'description',
    ];

    public function magazines()
    {
        return $this->belongsToMany(Magazine::class, 'product_magazine', 'product_id', 'magazine_id');
    }

}
