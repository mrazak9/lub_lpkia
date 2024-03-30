<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'notes'
    ];

    public function questionDetails()
    {
        return $this->hasMany(QuestionDetail::class, 'id_answer');
    }

    public function answer_detail()
    {
        return $this->hasMany(AnswerDetail::class, 'id_answer');
    }
}
