<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Traits\NotificationTrait;

class DoctorController extends ApiController
{
    use NotificationTrait;
    public function __construct()
    {
        $this->resource = DoctorResource::class;
        $this->model = app(Doctor::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $doctor = $this->repositry->save($request->all());

       $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $this->send('تم انضمام طبيب جديد لأسرتنا','مرحبا ',$FcmToken,true);


        return $this->returnSuccessMessage(__('The notification has been sent successfully!'));
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function lookfor(Request $request){

        return $this->search('name',$request->value);

    }



}
