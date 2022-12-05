<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    public $guarded = [];
    public $translatable = ['name'];

    public $timestamps = true;

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }
}
