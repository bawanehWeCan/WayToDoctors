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
        return $this->store( $request->all() );
    }

    // public function store( $data )
    // {
    //     $model = $this->repositry->save( $data );


    //     if ($model) {
    //         return $this->returnData( 'data' , new $this->resource( $model->doctor ), __('Succesfully'));
    //     }

    //     return $this->returnError(__('Sorry! Failed to create !'));
    // }



}
