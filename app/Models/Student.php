<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'classroom',
        'code',
        'prodi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'id_student');
    }
}
