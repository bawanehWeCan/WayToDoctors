<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use App\Repositories\Repository;
use App\Http\Requests\CertificateRequest;
use App\Http\Resources\CertificateResource;
use App\Http\Controllers\ApiController;

class CertificateController extends ApiController
{
    public function __construct()
    {
        $this->resource = CertificateResource::class;
        $this->model = app(Certificate::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( CertificateRequest $request ){
        return $this->store( $request->all() );
    }

}
