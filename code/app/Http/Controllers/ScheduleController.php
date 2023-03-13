<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

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
    public function timefactory($user)
    {
        $weeknumber = (int)date('W') +19;
        $weeks = [];

        $schedules = Schedule::where('abrev', $user)->get();
        foreach ($schedules as $schedule){
            $schedule->semaines = $this->week_convert($schedule->semaines);
            foreach ( $schedule->semaines as $week)
            {

                if (!in_array(["week"=>$week], $weeks)){
                    array_push($weeks,array("week"=>$week));
                }

            }


        }
        foreach ($schedules as $schedule){
            foreach ($weeks as $week)
            {

                if(in_array($week["week"],$schedule->semaines ))
                {

                    //$before = !in_array(["day"=>$schedule->jour], $week);
                    if(!in_array(["day"=>$schedule->jour], $week)){
                        array_push($week, array("day"=>$schedule->jour));

                    }
                    //$between = !in_array(["day"=>$schedule->jour], $week);
                    array_push($week[0], array($schedule->heure, $schedule->heure+ $schedule->duree));
                    //$after = !in_array(["day"=>$schedule->jour], $week);
                    return [$week, $weeks, $schedules];

                }
            }
        }





        return $weeks;


    }
    public function display(){


        $schedules = Schedule::where('abrev', auth()->user()->username)->get();
        foreach ($schedules as $schedule){
            $schedule->semaines = $this->week_convert($schedule->semaines);

        }
        $schedules = $this->timefactory(auth()->user()->username);


        return view('schedule',['schedules'=>$schedules]);


    }





}
