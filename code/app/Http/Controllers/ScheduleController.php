<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Controllers\Users_does_edtController;

class ScheduleController extends Controller
{
    //


    private function week_convert($string) :array
    {
        $res = [];
        if (str_contains($string,',')){
            $weeks =explode(',',$string);

            foreach ($weeks as $week){
                if (str_contains($week,'..')){
                    $list=explode('..',$week);
                    for ($i = (int)$list[0]; $i <=(int)$list[1]; $i++){

                         array_push($res,$i);
                    }

                }else{
                    array_push($res,(int)$week);;
                }

            }
        }
        else{
            if (str_contains($string,'..')){
                $list=explode('..',$string);
                for ($i = (int)$list[0]; $i <=(int)$list[1]; $i++){

                    array_push($res,$i);
                }

            }else{
                array_push($res,(int)$string);;
            }

        }


        return  $res;
    }
    public function timefactory($user,)
    {

        $weeks = [];
        $schedules = Schedule::where('abrev', $user)->orderby('jour')->orderby('heure')->get();
        foreach ($schedules as $schedule){
            $schedule->semaines = $this->week_convert($schedule->semaines);
            foreach ( $schedule->semaines as $week)
            {
                if (!in_array(["week"=>$week], $weeks)){
                    array_push($weeks,array("week"=>$week));
                }
            }
        }
        $weeks2 = [];
        foreach ($weeks as $week){
            $weekid= $week["week"];
            foreach ($schedules as $schedule)
            {
                if(in_array($weekid,$schedule->semaines ))
                {
                    if(!in_array(["day"=>$schedule->jour], $week)){
                        array_push($week, array("day"=>$schedule->jour));
                    }

                }
            }
            array_push($weeks2, $week);
        }

        $weeks3 = [];
        foreach ($weeks2 as $week){
            $weekid= $week["week"];
            $week3 = ["week"=>$week["week"]-19];
            foreach ($week as $day){

                if(is_array($day)){
                    $dayid = $day["day"];
                    foreach ($schedules as $schedule)
                    {
                        if(in_array($weekid,$schedule->semaines ) and ($dayid == $schedule->jour))
                        {
                            array_push($day, $schedule->heure, $schedule->heure+ $schedule->duree);

                        }
                    }

                    array_push($week3, $day);

                }

            }
            array_push($weeks3, $week3);
        }







        return [$weeks3 ];

    }
    public function display(){


        $schedules = Schedule::where('abrev', auth()->user()->username)->get();
        foreach ($schedules as $schedule){
            $schedule->semaines = $this->week_convert($schedule->semaines);

        }
        $schedules = $this->timefactory(auth()->user()->username,auth()->user()->id);


        return view('schedule',['schedules'=>$schedules]);


    }





}
