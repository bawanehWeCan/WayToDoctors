<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = true;

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answerRelation(){
        return $this->belongsTo(Answer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeCurrent( $query, $id ){
        return $query->where( 'question_id', $id );
    }
}
