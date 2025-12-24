<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope for active crews
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Newest first
    public function scopeOrdered($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
