<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mean extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'min_value',
        'max_value',
        'statement',
    ];
}
