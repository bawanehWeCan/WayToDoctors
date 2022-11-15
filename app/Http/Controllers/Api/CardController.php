<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Http\Resources\MyCardsResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Auth;

class CardController extends ApiController
{

    public function __construct()
    {
        $this->resource = CardResource::class;
        $this->model = app(Card::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function myCards(){


        // $user_id = Auth::user()->id;
         $user=Auth::user();
         return $this->returnData('data',  MyCardsResource::collection( $user->cards ), __('Get  succesfully'));

     }
}
