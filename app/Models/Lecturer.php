<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'prodi',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_dosen');
    }
}
