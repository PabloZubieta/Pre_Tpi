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
    public function display(){


        $schedules = Schedule::where('abrev', auth()->user()->username)->get();
        foreach ($schedules as $schedule){
            $schedule->semaine = $this->week_convert($schedule->semaine);
        }


        return view('schedule',['schedules'=>$schedules]);


    }
    public function timefactory($user)
    {
        $week = (int)date('W') +19;
        $days = [];

        $schedules = Schedule::where('abrev', $user)->get();
        foreach ($schedules as $schedule){
            $schedule->semaine = $this->week_convert($schedule->semaine);
            if( !in_array( $days , $schedule->day)){
                array_push($days , $schedule->day);

            }
        }
        foreach ($days as $day){

        }




        return ;


    }




}
