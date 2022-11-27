<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = true;

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }
}
