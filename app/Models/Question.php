<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = true;

    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
