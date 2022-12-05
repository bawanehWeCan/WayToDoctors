<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Answer extends Model
{
    use HasFactory, HasTranslations;

    public $guarded = [];
    public $translatable = ['answer'];

    public $timestamps = true;

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
