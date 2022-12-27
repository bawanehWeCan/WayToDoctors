<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','address','description'];

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('img/'), $filename);
            $this->attributes['image'] =  'img/'.$filename;
        }
    }

    public function certificates(){
        return $this->hasMany(Certificate::class);
    }

    public function studies(){
        return $this->hasMany(Study::class);
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function reviews(){
        return $this->morphToMany( Review::class, 'reviewable' );
    }

    public function categories(){
        return $this->morphToMany( Category::class, 'categoryable' );
    }
    public function users(){
        return $this->belongsToMany(User::class,'favorites','doctor_id','user_id');
    }

    // public function userDoctorID(){
    //     return $this->belongsTo(User_Doctor::class);
    // }

}
