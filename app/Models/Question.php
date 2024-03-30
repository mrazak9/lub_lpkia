<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'total',
        'notes',
        'start_date',
        'end_date',
        'is_active',
        'type', //student, lecturer, employee
    ];

    public function questionDetails()
    {
        return $this->hasMany(QuestionDetail::class, 'id_question');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'id_question');
    }

    public function response_statuses()
    {
        return $this->hasMany(ResponseStatus::class, 'id_question');
    }
}
