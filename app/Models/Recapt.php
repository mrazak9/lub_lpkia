<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recapt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_question',
        'id_response',
        'id_schedule',
        'total_response',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function response()
    {
        return $this->belongsTo(Response::class, 'id_response');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }

    public function recaptdetails()
    {
        return $this->hasMany(RecaptDetail::class, 'id_recapt');
    }
}
