<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Image;


class UserRepository extends AbstractRepository
{

      /**
     * holds the specific model itself.
     *
     * @var Model
     */
    protected $model;

    /**
     * Create new Library class.
     *
     * this abstraction expects the child class to have a protected attribute named model.
     * that will hold the model name with its full namespace.
     */
    public function __construct( Model $model )
    {
        $this->model = $model;
    }


    /**
     * saveRestaurant function
     *
     * @param object $data
     * @return object
     */
    public function save($data)
    {

        $model = $this->model->create([
            'name'=>$data->name,
            'email'=>$data->email,
           // 'phone'=>$data->phone,
            //'step'=>$data->step,
            //'active'=>$data->active,
            'password'=>Hash::make($data->password),
        ]);
        // $model->profile()->create($data->except([
        //     'name',
        //     'email',
        //     'phone',
        //     'step',
        //     'active',
        //     'image',
        //     'password',

        // ]));

        return $model->fresh();

    }


    public function edit($data,$user)
    {

        $user->update($data->all());

        $user->profile()->update($data->except([
            'name',
            'email',
            'phone',
            'step',
            'active',
            'image',

        ]));

        return $user->fresh();

    }
    /**
     * asignRoleToUser function
     *
     * @return Collection
     */
    public function asignRoleToUser($id, $roles)
    {
        try {

            $user = $this->model->where('id', $id)->firstOrFail();
            $user->syncRoles($roles);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function insertImage($file, $user, $update=false)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('img/users/'), $filename);
            $file_path = "img/users/".$filename;

            if( $update ){
                $i = Image::where('imageable_id',$user->id)->where('imageable_type',get_class($user))->first();
                $i->image = $file_path;
                return $i->save();
            }

            return $user->image()->updateOrCreate([
                'image' => $file_path,
                'imageable_id' => $user->id,
                'imageable_type' => get_class($user)
            ]);
        }
    }

}
