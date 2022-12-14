<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkHour;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\WorkHourRequest;
use App\Http\Resources\WorkHourResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class WorkHourController extends ApiController
{
    public function __construct()
    {
        $this->resource = WorkHourResource::class;
        $this->model = app(WorkHour::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function workhourForDoctor($doctor_id){


        $workhours = WorkHour::where('doctor_id',$doctor_id)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($workhours ), __('Get  succesfully'));

    }

    public function workhourForClinic($clinic_id){


        $workhours = WorkHour::where('clinic_id',$clinic_id)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($workhours ), __('Get  succesfully'));

    }
}
