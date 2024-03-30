<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponseStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_student',
        'id_response',
        'is_response',
        'id_schedule',
        'id_question',
    ];
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function response()
    {
        return $this->belongsTo(Response::class, 'id_response');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}
