<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'concepts_id',
        'questions_id'
    ];


    protected $casts = [
        'concepts_id' => 'array',
        'questions_id' => 'array',
    ];
}
