<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'label'
    ];

    public function cours(){
        return $this->belongsToMany(Cours::class,'cours_themes');
    }

}
