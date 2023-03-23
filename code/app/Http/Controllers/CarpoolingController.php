<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carpooling;
use App\Models\Users_has_carpooling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CarpoolingController extends Controller
{
    //
    public function create(){
        $places = DB::table('places')->select('id')->get();
        $date =date('Y-m-d',strtotime('tomorrow')).'%';
        $placecars =[];

        foreach ($places as $place){
            $entries = DB::table('users_does_edt')->join('users','users_does_edt.users_id',"=" ,'users.id')->select('users.id','starting_hour','finnishing_hour','users.username','users.car_seat')->where('starting_hour','like',$date)->where('users.place_id','=',$place->id)->get();
            $entries= $entries->groupBy('starting_hour');
            if(sizeof($entries)>=1){
                $placeentries =[];

                foreach ($entries as $entry) {

                    if(sizeof($entry)>1){

                        array_push($placeentries,['time'=>$entry[0]->starting_hour,  $entry]);
                    }
                }
                if (!empty($placeentries)){
                    array_push($placecars,['id'=>$place->id, $placeentries]);
                }

            }

        }



        $carpoolings= [];


        foreach ($placecars as $place ){
            foreach ($place as $placecar){

                if (is_array($placecar)){
                    $teachernb = sizeof($placecar[0]);

                    while($teachernb>1)
                    {
                        $driver = $placecar[0][0][0];

                        $placecar[0][0]=$placecar[0][0]->slice(1);


                        if(sizeof($placecar[0][0])<=$driver->car_seat )
                        {
                            $carpoolers = $placecar[0][0];

                            $teachernb =0;
                        }else
                        {
                            $carpoolers= [];

                            for ($i =0; $i< $driver->car_seat;$i++){
                                array_push($carpoolers, $placecar[0][0][$i]);
                            }


                            $placecar[0][0]=$placecar[0][0] ->slice($driver->car_seat);
                            $teachernb -= ($driver->car_seat +1);
                        }

                        array_push($carpoolings , ['id'=>$place['id'],'time'=>$placecar[0]['time'],'driver'=>$driver, 'carpoolers'=>$carpoolers]);

                    }
                }

            }


        }

        foreach ($carpoolings as $carpooling){

            $entries = [
                'carpooling_time' =>$carpooling['time'],
                'place_id'=>$carpooling['id'],
                'driver_id'=>$carpooling['driver']->id

            ];

            $idcarpolling = Carpooling::insertGetId($entries);




            foreach ($carpooling['carpoolers'] as $carpooler){
                $entry =[
                    'carpooling_id' =>$idcarpolling,
                    'users_id'=>$carpooler->id
                ];
                Users_has_carpooling::create($entry);

            }


        }







    }
}
