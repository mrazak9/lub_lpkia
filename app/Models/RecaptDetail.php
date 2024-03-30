<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecaptDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'recapt_id',
        'question_detail_id',
        'value'
    ];

    public function recapt()
    {
        return $this->belongsTo(Recapt::class, 'recapt_id');
    }

    public function questionDetail()
    {
        return $this->belongsTo(QuestionDetail::class, 'question_detail_id');
    }
}
