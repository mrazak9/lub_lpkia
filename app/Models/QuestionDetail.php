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
        'question_group_id',
        'question_id',
        'answer_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class);
    }

    public function recaptDetail()
    {
        return $this->hasMany(RecaptDetail::class, 'id_question_detail');
    }
}
