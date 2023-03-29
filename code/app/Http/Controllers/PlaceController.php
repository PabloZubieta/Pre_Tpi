<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CarpoolingController;
use Illuminate\Http\Request;
use App\Models\Place;


class PlaceController extends Controller
{

    //
    public function check($request){

        CarpoolingController::daily_loop();
        CarpoolingController::create();
        $place = Place::firstWhere('name', $request);
        if($place){

            return $place->id;
        }
        else{
           $place = new Place;
           $place->name = $request->name;
           $place = Place::firstWhere('name', $request);
           return $place->id;
        }
    }


}
