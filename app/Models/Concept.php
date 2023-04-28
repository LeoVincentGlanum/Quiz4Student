<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'label'
    ];

    public function themes(){
        return $this->belongsToMany(Theme::class,'concepts_themes');
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

}
