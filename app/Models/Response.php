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
        'question6',
        'question7',
        'question8',
        'question9',
        'question10',
        'question11',
        'question12',
        'question13',
        'question14',
        'question15',
        'question16',
        'question17',
        'question18',
        'question19',
        'question20',
        'question21',
        'question22',
        'question23',
        'question24',
        'question25',
        'question26',
        'question27',
        'question28',
        'question29',
        'question30',
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
