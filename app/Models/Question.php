<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use CrudTrait;
    use HasFactory;


    public function concept()
    {
        return $this->hasOne(Concept::class);
    }

}
