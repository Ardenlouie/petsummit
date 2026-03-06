<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'summit_2026_test';

    protected $casts = [
        'pets' => 'array',
        'store' => 'array',
        'product' => 'array',
        'brand' => 'array',
        'switch' => 'array',
    ];

    protected $fillable = [
        'name',
        'email',
        'control_number',
        'pets',
        'spend',
        'store',
        'product',
        'brand',
        'switch',
        'bath',
        'attendance',
    ];
 

}
