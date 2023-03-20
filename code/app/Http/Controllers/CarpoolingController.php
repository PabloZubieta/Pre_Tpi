<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carpooling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CarpoolingController extends Controller
{
    //
    public function create(){
        $places = DB::table('places')->select('id')->get();
        $date =date('Y-m-d',strtotime('tomorrow')).'%';
        $placecar =[];
        foreach ($places as $place){
            $entry = DB::table('users_does_edt')->join('users','users_does_edt.users_id',"=" ,'users.id')->select('users_does_edt.id','starting_hour','finnishing_hour','users.username','users.car_seat')->where('starting_hour','like',$date)->where('users.place_id','=',$place->id)->get();
            if(sizeof($entry)>1){
                array_push($placecar,[$place->id,$entry]);
            }

        }
        //$entry = DB::table('users_does_edt')->join('users','users_does_edt.users_id',"=" ,'users.id')->select('users_does_edt.id','starting_hour','finnishing_hour','users.username','users.car_seat','users.place_id')->where('starting_hour','like',$date)->get();
        //SELECT starting_hour, finnishing_hour, users.username, users.car_seat, users.place_id FROM users_does_edt INNER JOIN users ON users_does_edt.users_id = users.id WHERE starting_hour between '2023-03-20 00:00:00' AND '2023-03-21 00:00:00';

        return $placecar;
    }
}
