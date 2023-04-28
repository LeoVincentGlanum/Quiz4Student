<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use CrudTrait;
    use HasFactory;


    protected $fillable = [
        'concept_id',
        'label',
        'feedback',
        'reponses'
    ];

    protected $casts = [
        'reponses' => 'object'
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }
}
