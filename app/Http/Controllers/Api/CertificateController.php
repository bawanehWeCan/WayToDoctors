<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\CertificateRequest;

class CertificateController extends ApiController
{
    public function __construct()
    {
        $this->resource = CertificateResource::class;
        $this->model = app(Certificate::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
