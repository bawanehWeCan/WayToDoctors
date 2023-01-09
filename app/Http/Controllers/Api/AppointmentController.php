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


        // $user = User::find( $user_id );
        $appointments = Appointment::where('user_id',$user_id)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($appointments ), __('Get  succesfully'));

    }

    public function appointmentsByDoctor($doctor_id){


        $appointments = Appointment::where('doctor_id',$doctor_id)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($appointments ), __('Get  succesfully'));

    }

    public function appointmentsByClinic($clinic_id){


        $appointments = Appointment::where('clinic_id',$clinic_id)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($appointments ), __('Get  succesfully'));

    }

    public function checkType($doctor_id){


        $check = Appointment::where('doctor_id',$doctor_id)->where('type','Urgent')->get();


       if(Count($check) > 0){

        return $this->returnSuccessMessage(__('True'));

       }

       else{

        return $this->returnError(__('False'));

       }

    }

    public function getCounters(){

        $data = array();

        $data['completed']=Appointment::where('status','Finished')->count();
        // dd($data['complete']);
        $data['notCompleted']=Appointment::where('status','!=','Finished')->count();

        return $this->returnData( 'data' ,  $data , __('Succesfully'));


       }

       public function appByDateForDoctor(Request $request){


        $appointments = Appointment::where('doctor_id',$request->doctor_id)->where('date',$request->date)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($appointments ), __('Get  succesfully'));

    }

    public function appByDateForClinic(Request $request){


        $appointments = Appointment::where('clinic_id',$request->clinic_id)->where('date',$request->date)->paginate(10) ;

        return $this->returnData('data',  $this->resource::collection($appointments ), __('Get  succesfully'));

    }

}
