<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'courses_name',
        'id_lecturer',
        'periode',
        'classroom',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'id_lecturer');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'id_schedule');
    }

    public function response_statuses()
    {
        return $this->hasMany(ResponseStatus::class, 'id_schedule');
    }

    static function getPeriod()
    {
        $year = date('Y');
        $period = [];
        for ($i = $year-2; $i <= $year+2; $i++) {
            $period[$i.'-Ganjil'] = $i.'-Ganjil';
            $period[$i.'-Genap'] = $i.'-Genap';
        }
        return $period;
    }    
}
