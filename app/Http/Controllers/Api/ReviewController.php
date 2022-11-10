<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Resources\ReviewResource;
use Auth;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->resource = ReviewResource::class;
        $this->model = app(Review::class);
        $this->repositry =  new Repository($this->model);
    }

    public function test(){
        return $this->list();
    }

    public function save(ReviewRequest $request ){
        $request['user_id'] = Auth::user()->id;
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){
        $request['user_id'] = Auth::user()->id;
        return $this->update($id,$request->all());

    }

    public function addToDoctor( Request $request, $doctor_id ){


        $review = $this->repositry->save( $request->all() );

        $doctor = Doctor::find( $doctor_id );

        $doctor->reviews()->save( $review );


        return $this->returnSuccessMessage(__('Added succesfully!'));
    }


    public function getByDoctor( $doctor_id ){

        $doctor = Doctor::find( $doctor_id );
        // dd( $doctor );


        return $this->returnData('data',  $this->resource::collection( $doctor->reviews ), __('Get  succesfully'));
    }


}
