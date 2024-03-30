<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'notes', 'id_question'];

    public function question_details()
    {
        return $this->hasMany(QuestionDetail::class, 'id_question_group');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}
