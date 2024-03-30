<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question',
        'sequence',
        'id_question_group',
        'id_question',
        'id_answer'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'id_answer');
    }

    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class, 'id_question_group');
    }

    public function recaptDetail()
    {
        return $this->hasMany(RecaptDetail::class, 'id_question_detail');
    }
}
