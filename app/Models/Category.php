<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('img/cats/'), $filename);
            $this->attributes['image'] =  'img/cats/'.$filename;
        }
    }

    public function suppliers(){
        return $this->morphedByMany( User::class, 'categoryable' );
    }

    public function products(){
        return $this->morphedByMany( Product::class, 'categoryable' );
    }

    public function blog(){
        return $this->morphByMany( Blog::class, 'categoryable' );
    }

    public function doctor(){
        return $this->morphByMany( Doctor::class, 'categoryable' );
    }
}
