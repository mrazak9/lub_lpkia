<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id_answer','name', 'code', 'value'];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'id_answer');
    }
}
