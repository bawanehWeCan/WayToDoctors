<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\RelativeResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorUserResource;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->resource = UserResource::class;
        $this->model = app(User::class);
        $this->repositry = new UserRepository($this->model);
    }

    public function save(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->repositry->save($request);
            if ($request->has('image')) {
                $this->repositry->insertImage($request->image, $user);
            }
            DB::commit();
            return $this->returnData('user', new $this->resource($user), 'User created Successfully');
        } catch (\Exception$e) {
            DB::rollback();
            return $e;
            return $this->returnError('Sorry! Failed in creating user');
        }
    }
    // public function edit( $id,ProfileUpdateRequest $request ){
    //     try {
    //         DB::beginTransaction();
    //         $user = $this->model->find($id);
    //         // check unique email except this user
    //         if (isset($request->email)) {
    //             $check = User::where('email', $request->email)
    //                 ->first();

    //             if ($check) {

    //                 return $this->returnError('The email address is already used!');
    //             }
    //         }

    //         $this->repositry->edit($request,$user);

    //         if ($request->has('image') && $user->has('image')) {
    //             $image = $this->repositry->insertImage($request->image,$user,true);
    //         }elseif ($request->has('image')) {
    //             $image = $this->repositry->insertImage($request->image,$user);
    //         }

    //         DB::commit();
    //         unset($user->image);
    //         return $this->returnData('user', new $this->resource($user), 'User updated successfully');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return $this->returnError('Sorry! Failed in updating user');
    //     }
    // }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        // check unique email except this user
        if (isset($request->email)) {
            $check = User::where('email', $request->email)->where('email', '!=', $user->email)
                ->first();

            if ($check) {

                return $this->returnError('The email address is already used!');
            }
        }

        if ($request->has('image') && $user->has('image')) {
            $image = $this->repositry->insertImage($request->image, $user, true);
        } elseif ($request->has('image')) {
            $image = $this->repositry->insertImage($request->image, $user);
        }

        $user->update(
            $request->only([
                'name',
                'email',
                'phone',
                'step',
                'active',

                'password',
            ])
        );
        $pr = Profile::where('user_id',$user->id)->first();
        if( $pr ){
            $pr->update($request->except([
                'name',
                'email',
                'phone',
                'step',
                'active',
                'image',
                'password',

            ]));

            return $this->returnData('user', UserResource::make($user), 'User updated successfully');
        }

        $user->profile()->updateOrCreate($request->except([
            'name',
            'email',
            'phone',
            'step',
            'active',
            'image',
            'password',

        ]));

        return $this->returnData('user', UserResource::make($user), 'User updated successfully');
    }


    public function myFavorites()
    {

        $favorites = Auth::user()->favorites;
        return $this->returnData('data',  DoctorResource::collection( $favorites ), __('Get  succesfully'));

    }

    public function myDoctors()
    {
        $doctors = Auth::user()->doctors;
        return $this->returnData('data',  DoctorResource::collection( $doctors ), __('Get  succesfully'));

    }

    public function myRelatives($user_id)
    {

        $relatives = User::find($user_id)->relatives;
        return $this->returnData('data',  RelativeResource::collection( $relatives ), __('Get  succesfully'));

    }
}
