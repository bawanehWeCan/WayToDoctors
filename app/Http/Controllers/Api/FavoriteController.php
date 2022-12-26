<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\myFavoriteResource;
use App\Http\Resources\DoctorResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\Doctor;

class FavoriteController extends ApiController
{
    public function __construct()
    {
        $this->resource = FavoriteResource::class;
        $this->model = app(Favorite::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $model = Favorite::where('doctor_id',$request->doctor_id)->where('user_id',$request->user_id)->first();

        if($model){
            return $this->returnError(__('Sorry! Doctor already exist !'));
        }
        return $this->store( $request->all() );
    }

    public function deletebyID( $doctor_id, $user_id ){


        $model = Favorite::where('doctor_id',$doctor_id)->where('user_id',$user_id)->first();

        if (!$model) {
            return $this->returnError(__('Sorry! Failed to get !'));
        }

        $model->delete();



        return $this->returnSuccessMessage(__('Delete succesfully!'));


    }



}
