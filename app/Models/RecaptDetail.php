<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecaptDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_recapt',
        'id_question_detail',
        'value'
    ];

    public function recapt()
    {
        return $this->belongsTo(Recapt::class, 'id_recapt');
    }

    public function questionDetail()
    {
        return $this->belongsTo(QuestionDetail::class, 'id_question_detail');
    }
}
