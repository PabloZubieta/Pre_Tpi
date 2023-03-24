<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carpooling;
use App\Models\User;
use App\Models\Users_has_carpooling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;


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


    public function display(){
        //$this->create();
        $lastdriven=Carpooling::where('driver_id','=',auth()->user()->id)
            ->where('carpooling_3/4','=',1)
            ->leftjoin('users_has_carpooling','carpooling.id','=','users_has_carpooling.carpooling_id')
            ->join('places','carpooling.place_id','=','places.id')
            ->join('users','users_has_carpooling.users_id','=','users.id')
            ->select('carpooling.id', 'carpooling.carpooling_time', 'carpooling.driver_id', 'places.name', 'users.username')
            ->get();
        if($lastdriven->isNotEmpty()){
            $lastdriven_maxid= $lastdriven->max('id');
            $lastdriven = $lastdriven->sortByDesc('id')->groupBy('id');
            $lastdriven =$lastdriven[$lastdriven_maxid];
        }






        $lasttakenid=Users_has_carpooling::where('users_id','=',auth()->user()->id)->select('carpooling_id')->join('carpooling','users_has_carpooling.carpooling_id','=','carpooling.id')->where('carpooling_3/4','=',1)->where('user_confirm','=',1)->orderByDesc('carpooling.id')->limit(1)->get();
        if(!$lasttakenid->isEmpty())
        {

            $lasttaken=Carpooling::where('carpooling.id','=',$lasttakenid[0]->carpooling_id)
                ->where('user_confirm','=',1)
                ->leftjoin('users_has_carpooling','carpooling.id','=','users_has_carpooling.carpooling_id')
                ->join('places','carpooling.place_id','=','places.id')
                ->join('users','users_has_carpooling.users_id','=','users.id')
                ->select('carpooling.id', 'carpooling.carpooling_time', 'carpooling.driver_id', 'places.name', 'users.username')
                ->get();
            $lasttaken[0]->driver_id =(User::where('id','=',$lasttaken[0]->driver_id)->select('username')->get())[0]->username;



        }
        else{
            $lasttaken=collect([]);
        }


        $nextcarpoolingid=Carpooling::leftjoin('users_has_carpooling','carpooling.id','=','users_has_carpooling.carpooling_id')
            ->where('carpooling_3/4')

            ->
            where(function ($query) {
                $query->where('driver_id','=',auth()->user()->id)
                    ->orWhere(
                    function ($query2) {
                        $query2->where('users_id','=',auth()->user()->id)
                            ->
                            where(function ($query3) {
                                $query3->where('user_confirm')
                                    ->orWhere('user_confirm','=',1);
                            });
                    });
            })

            ->limit(1)->select('carpooling.id')->get();

        if(!$nextcarpoolingid->isEmpty())
        {

            $nextcarpooling=Carpooling::where('users_has_carpooling.carpooling_id','=',$nextcarpoolingid[0]->id)
                ->
                where(function ($query) {
                    $query->where('user_confirm')
                        ->orWhere('user_confirm','=',1);
                })
                ->leftjoin('users_has_carpooling','carpooling.id','=','users_has_carpooling.carpooling_id')
                ->join('places','carpooling.place_id','=','places.id')
                ->join('users','users_has_carpooling.users_id','=','users.id')
                ->select('carpooling.id', 'carpooling.carpooling_time', 'carpooling.driver_id', 'places.name', 'users.username')
                ->get();




            $nextcarpooling[0]->driver_id =(User::where('id','=',$nextcarpooling[0]->driver_id)->select('username')->get())[0]->username;



        }
        else{
            $nextcarpooling=collect([]);
        }

        return view('carpooling',['lastdriven'=>$lastdriven,'lasttaken'=>$lasttaken,'nextcarpooling'=>$nextcarpooling]);



    }

    public function validate_carpool(Request $request){





        return back();



    }
}
