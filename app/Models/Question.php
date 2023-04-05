<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'total',
        'notes',
        'id_schedule',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }

    public function questionDetails()
    {
        return $this->hasMany(QuestionDetail::class, 'id_question');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'id_question');
    }
}
