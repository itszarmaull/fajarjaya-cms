<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorOption extends Model
{
    protected $fillable = [
        'type',
        'name',
        'price',
        'is_active',
        'sort_order',
    ];
}
