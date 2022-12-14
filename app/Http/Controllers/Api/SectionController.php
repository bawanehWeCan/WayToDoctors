<?php

namespace App\Http\Controllers\Api;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\SectionResource;

class SectionController extends ApiController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->resource = SectionResource::class;
        $this->model = app(Section::class);
        $this->repositry =  new Repository($this->model);
    }


    public function list()
    {

        $data =  Section::where('id','!=',1000)->get();

        return $this->returnData( 'data' , $this->resource::collection( $data ), __('Succesfully'));


    }

    public function save( Request $request ){

        return $this->store( $request->all() );

    }

    public function edit( $id,Request $request){
        return $this->update($id,$request->all() );

    }
}
