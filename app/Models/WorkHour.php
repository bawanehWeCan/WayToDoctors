<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WorkHour extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded=[];
    public $translatable = ['name'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
}
