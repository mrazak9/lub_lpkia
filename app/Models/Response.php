<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_schedule',
        'id_student',
        'id_question',
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'comment1',
        'comment2',
        'comment3'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function responseStatuses()
    {
        return $this->hasMany(ResponseStatus::class, 'id_response');
    }
}
