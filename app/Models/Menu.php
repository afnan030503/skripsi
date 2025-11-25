<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id', // penting ditambahkan
        'name',
        'description',
        'price',
        'image',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
