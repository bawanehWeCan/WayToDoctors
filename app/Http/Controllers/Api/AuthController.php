<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordChangeRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseTrait;


    /**
     * @var UserRepository
     */
    protected $userRepositry;

    public function __construct()
    {
        $this->userRepositry = new UserRepository(app(User::class));
    }


    public function login(AuthRequest $request)
    {
        $auth = Auth::attempt(
            $request->only([
                'phone',
                'password',
            ])
        );

        if (!$auth) {


            return response()->json([
                'status' => false,
                'code' => 500,
                'msg' => __('Invalid credentials!'),
            ], 500);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;



        return response(['status' => true, 'code' => 200, 'msg' => __('Log in success'), 'data' => [
            'token' => $accessToken,
            'user' => UserResource::make(Auth::user())
        ]]);
    }

    //     return response(['status' => true, 'code' => 200, 'msg' => __('Log in success'), 'data' => [
    //         'token' => $accessToken,
    //         'user' => UserResource::make(Auth::user())
    //     ]]);

    // }


    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepositry->save($request);

            // if ($request->has('image')) {
            //     $this->userRepositry->insertImage($request->image,$user);
            // }





            // $otp = $this->sendOTP($request->phone);

            // $user->otp = $otp;
            // $user->save();


            DB::commit();
            Auth::login($user);

            $accessToken = Auth::user()->createToken('authToken')->accessToken;

            if ($user) {
                // return $this->returnData( 'user', UserResource::make($user), '');


                return response(['status' => true, 'code' => 200, 'msg' => __('User created succesfully'), 'data' => [
                    'token' => $accessToken,
                    'user' => UserResource::make(Auth::user())
                ]]);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return $this->returnError('Sorry! Failed in creating user');
        }
    }

    public function check(Request $request)
    {
        if ($this->checkOTP($request->phone, $request->code)) {
            return $this->returnSuccessMessage('success');
        } else {
            return $this->returnError('Sorry! code not correct');
        }
    }








    public function profile(Request $request)
    {
        return $this->returnData('user', UserResource::make(Auth::user()), 'successful');
    }

    public function userProfile($id)
    {
        return $this->returnData('user', UserResource::make(User::find($id)), 'successful');
    }

    public function password(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user) {

            $otp = $this->sendOTP($request->phone);
            $user->otp = $otp;
            $user->save();

            return $this->returnSuccessMessage('Code was sent');
        }

        return $this->returnError('Code not sent User not found');
    }


    public function changePassword(PasswordChangeRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user) {

            User::find($user->id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);

            return $this->returnSuccessMessage('Password has been changed');
        }

        return $this->returnError('Password not matched!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();



        return $this->returnSuccessMessage('Done!');
    }


    public function updatePhone(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->phone = $request->phone;
            $user->save();

            $otp = $this->sendOTP($request->phone);

            $user->otp = $otp;
            $user->save();



            return $this->returnSuccessMessage('Code was sent!');
        } catch (Exception $th) {
            dd( $th );
        }
    }


    public function resendOTP(Request $request, $id)
    {
        $user = User::find($id);

        $otp = $this->sendOTP($user->phone);

        $user->otp = $otp;
        $user->save();



        return $this->returnSuccessMessage('Code was sent!');
    }


    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            // check unique email except this user
            if (isset($request->email)) {
                $check = User::where('email', $request->email)
                    ->first();

                if ($check) {

                    return $this->returnError('The email address is already used!');
                }
            }


            $this->userRepositry->edit($request, $user);

            if ($request->has('image') && $user->has('image')) {
                $image = $this->userRepositry->insertImage($request->image, $user, true);
            } elseif ($request->has('image')) {
                $image = $this->userRepositry->insertImage($request->image, $user);
            }

            DB::commit();
            unset($user->image);
            return $this->returnData('user', new UserResource($user), 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;

            return $this->returnError('Sorry! Failed in updating user');
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();

        return $this->returnSuccessMessage('Logged out succesfully!');
    }

    public function sendOTP($phone)
    {
        $otp = 5555;
        // $otp = mt_rand(1000, 9999);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "://82.212.81.40:8080/websmpp/websms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "user=Wecan&pass=Suh12345&sid=WayToDoctor&mno=" . $phone . "&text=Your OTP is " . $otp . " for your account&type=1&respformat=json",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer 2c1d0706b21b715ff1e5a480b8360d90"
            ),
        ));

        curl_exec($curl);

        curl_close($curl);

        return $otp;
    }

    public function checkOTP($phone, $otp)
    {
        $user = User::where('phone', $phone)->first();

        if ((string)$user->otp == (string)$otp) {
            $user->active = 1;
            $user->save();
            return true;
        }

        return false;
    }
}
