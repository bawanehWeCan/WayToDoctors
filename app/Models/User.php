<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','step','active','question_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setImageAttribute($value){
    //     if ($value){
    //         $file = $value;
    //         $extension = $file->getClientOriginalExtension(); // getting image extension
    //         $filename =time().mt_rand(1000,9999).'.'.$extension;
    //         $file->move(public_path('img/users/'), $filename);
    //         $this->attributes['image'] =  'img/users/'.$filename;
    //     }
    // }

    // public function setCoverAttribute($value){
    //     if ($value){
    //         $file = $value;
    //         $extension = $file->getClientOriginalExtension(); // getting image extension
    //         $filename =time().mt_rand(1000,9999).'.'.$extension;
    //         $file->move(public_path('img/users/'), $filename);
    //         $this->attributes['cover'] =  'img/users/'.$filename;
    //     }
    // }


    public function get_roles()
    {
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function cards(){
        return $this->hasMany(Card::class);
    }

    public function categories(){
        return $this->morphToMany( Category::class, 'categoryable' );
    }

    public function profile(){
        return $this->hasOne(Profile::class);

    }

    //morph
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }



    public function favorites(){
        return $this->belongsToMany(Doctor::class,'favorites','user_id','doctor_id')->paginate(10);
    }
    public function doctors(){
        return $this->belongsToMany(Doctor::class,'user__doctors','user_id','doctor_id')->paginate(10);
    }

    public function relatives(){
        return $this->hasMany(Relative::class);
    }

}
