<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $attributes = [
    'is_active' => true,
    ];

}
