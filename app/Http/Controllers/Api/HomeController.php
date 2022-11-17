<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Doctor;
use App\Repositories\Repository;
use App\Http\Resources\SliderResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\BlogResource;

class HomeController extends ApiController
{

    public function __construct()
    {
        $this->resource = SliderResource::class;
        $this->model = app(Slider::class);
        $this->repositry =  new Repository($this->model);
    }

    public function homePage(){

        $data = array();
        $data['sliders']=SliderResource::collection( Slider::all());
        $data['doctors']=DoctorResource::collection(Doctor::all());
        $data['blogs']=BlogResource::collection(Blog::all());


        return $this->returnData( 'data' ,  $data , __('Succesfully'));



    }
}
