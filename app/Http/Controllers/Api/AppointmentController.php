<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\File;
use App\Traits\NotificationTrait;

class AppointmentController extends ApiController
{
    use NotificationTrait;
    public function __construct()
    {
        $this->resource = AppointmentResource::class;
        $this->model = app(Appointment::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $appointment = $this->repositry->save($request->except('file_path'));

        foreach ($request->file_path as $path) {
            $file = new File();
            $file->file = $path;
            $file->appointment_id = $appointment->id;
            $file->save();
        }



        $user = User::find($appointment->user_id);

        $token = $user->device_token;

        if($appointment->status == "Canceled")
        {
        $this->send('تم إلغاء حجزك','مرحبا ',$token);


        $note = new Notification();
        $note->content = 'تم إلغاء حجزك';
        $note->user_id = $appointment->user_id;
        $note->save();
        }

        elseif($appointment->status == "Approved")
        {

            $this->send('تم الموافقة على حجزك','مرحبا ',$token);


            $note = new Notification();
            $note->content = 'تم الموافقة على حجزك';
            $note->user_id = $appointment->user_id;
            $note->save();
        }

        else
        {

            $this->send('طلبك قيد الانتظار','مرحبا ',$token);


            $note = new Notification();
            $note->content = 'طلبك قيد الانتظار';
            $note->user_id = $appointment->user_id;
            $note->save();

        }

        return $this->returnData('data',  $this->resource::make($appointment ), __('Get  succesfully'));

        return $this->returnSuccessMessage(__('The notification has been sent successfully!'));
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function nextAppointmentList(){

        return $this->listWithCondition('status','Binding');
    }

    public function finishedAppointmentList(){

        return $this->listWithCondition('status','Finished');
    }

    public function canceledAppointmentList(){

        return $this->listWithCondition('status','Canceled');
    }

    public function myNextAppointments($user_id){

        $user = User::find( $user_id );
        $data= $user->appointments()->where('status','Binding')->paginate(10);

        return $this->returnData('data',  $this->resource::collection($data ), __('Get  succesfully'));

    }

    public function myFinishedAppointments($user_id){

        $user = User::find( $user_id );
        $data= $user->appointments()->where('status','Finished')->paginate(10);

        return $this->returnData('data',  $this->resource::collection($data ), __('Get  succesfully'));

    }

    public function myCanceledAppointments($user_id){

        $user = User::find( $user_id );
        $data= $user->appointments()->where('status','Canceled')->paginate(10);

        return $this->returnData('data',  $this->resource::collection($data ), __('Get  succesfully'));

    }

    public function myAppointments($user_id){

        $user = User::find( $user_id );

        return $this->returnData('data',  $this->resource::collection($user->appointments ), __('Get  succesfully'));

    }

}
