<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
}
