<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

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

    public function addToBlog( Request $request, $blog_id ){


        $category = $this->repositry->save( $request->all() );

        $blog = Blog::find( $blog_id );

        $blog->categories()->save( $category );


        return $this->returnSuccessMessage(__('Added succesfully!'));
    }


    public function getByBlog( $blog_id ){

        $blog = Blog::find( $blog_id );

      return $this->returnData('data',  $this->resource::collection( $blog->categories ), __('Get  succesfully'));
    }


}
