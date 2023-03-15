<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users_does_edt;

class Users_does_edtController extends Controller
{
    //
    private function int_to_time($hour){
        switch ($hour)
        {
            case 1:
                return "0800";
            case 2:
                return "0850";
            case 3:
                return "0950";
            case 4:
                return "1040";
            case 5:
                return "1130";
            case 6:
                return "1220";
            case 7:
                return "1330";
            case 8:
                return "1420";
            case 9:
                return "1520";
            case 10:
                return "1605";
            case 11:
                return "1655";
            case 12:
                return "1745";
            case 13:
                return "1830";
            case 14:
                return "1945";
            case 15:
                return "2010";
            case 16:
                return "2100";
            default:
                return "error";




        }


    }


    private function array_to_date($weeks){

        date_default_timezone_set('Europe/Paris');

        $weeknumber = (int)date('W') +19;

        $year = "2023";

        $times=[];


        foreach ($weeks as $week)
        {

            $weekY =strval( $week["week"] );
            if (strlen($weekY)==1){
                $weekY ="0".$weekY;
            }

                foreach ($week as $day) {

                    if(is_array($day)) {


                        $dayW = strval($day["day"] + 1);



                        $starttime = date("Y-m-d H:i:s", strtotime($year . "W" . $weekY . $dayW . ($this->int_to_time($day[0]))));

                        $finishtime = date("Y-m-d H:i:s", strtotime($year . "W" . $weekY . $dayW . ($this->int_to_time(($day[sizeof($day) - 2])))));
                        array_push($times, [$starttime, $finishtime]);
                    }

                }



        }



        return $times;


    }
    public function insert_hour($weeks,$user_id)
    {
        $times = $this->array_to_date($weeks);
        foreach ($times as $time)
        {
            $entry = [
                'starting_hour' =>$time[0],
                'finnishing_hour'=>$time[1],
                'users_id'=>$user_id ,
                'edt_id' => 1

            ];
            Users_does_edt::create($entry);

        }



    }



}
