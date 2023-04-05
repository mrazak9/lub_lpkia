<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'courses_name',
        'id_dosen',
        'periode',
        'classroom',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'id_dosen');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'id_schedule');
    }
}
