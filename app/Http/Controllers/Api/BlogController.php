<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Notification;
use App\Models\User;
use App\Http\Resources\ListsResource;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Traits\NotificationTrait;

class BlogController extends ApiController
{
    use NotificationTrait;
    public function __construct()
    {
        $this->resource = BlogResource::class;
        $this->model = app(Blog::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $blog = $this->repositry->save($request->all());

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $this->send('تم إضافة مدونة جديدة','مرحبا ',$FcmToken,true);


        return $this->returnSuccessMessage(__('The notification has been sent successfully!'));


    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


    public function getLists(){

        $data = array();

        $data['recent']=BlogResource::collection($this->repositry->all() );
        $data['cats']=CategoryResource::collection( Category::where('type','blog')->paginate(10) );
        $data[ 'random' ]= BlogResource::make( Blog::inRandomOrder()->first() );
        return $this->returnData( 'data' ,  $data , __('Succesfully'));


       }

       public function randomBlogs(){


        $data=Blog::inRandomOrder()->limit(5)->get();
        return $this->returnData('data',  BlogResource::collection( $data ), __('Get  succesfully'));

       }
}
