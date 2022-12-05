<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasFactory, HasTranslations;

    public $guarded = [];
    public $translatable = ['question'];

    public $timestamps = true;

    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
