<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Blog;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\DoctorResource;

class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->resource = CategoryResource::class;
        $this->model = app(Category::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( CategoryRequest $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function addToBlog( Request $request, $blog_id ){


        $category = $this->repositry->getByID($request->category_id);
        $blogRepo = new Repository( app( Blog::class ) );

        $blog = $blogRepo->getByID( $blog_id );

        $blog->categories()->save( $category );


        return $this->returnSuccessMessage(__('Added succesfully!'));
    }



    public function getBlogs($category_id){

    $category = Category::find( $category_id );
    return $this->returnData('data',  BlogResource::collection( $category?->blogs ), __('Get  succesfully'));

}

    public function getByBlog( $blog_id ){

        $blog = Blog::find( $blog_id );

      return $this->returnData('data',  $this->resource::collection( $blog->categories ), __('Get  succesfully'));
    }



    public function addToDoctor( Request $request, $doctor_id ){


        $category = $this->repositry->getByID($request->category_id);

        $doctorRepo = new Repository( app( Doctor::class ) );

        $doctor = $doctorRepo->getByID( $doctor_id );

        $doctor->categories()->save( $category );


        return $this->returnSuccessMessage(__('Added succesfully!'));
    }




    public function getCategoriesForDoctors(){


        $data = array();
        $data['cats']=CategoryResource::collection( Category::where('type','network')->get() );
        $data['doctors']=DoctorResource::collection(Doctor::all() );
    //    dd($data['doctors']);

        return $this->returnData( 'data' ,  $data , __('Succesfully'));


       }


       public function getDoctors($category_id){

        $category = Category::find( $category_id );
        return $this->returnData('data',  DoctorResource::collection( $category->doctors ), __('Get  succesfully'));

       }

     public function getCategoryByType($type){

        return $this->listWithCondition('type',$type);
     }


}
