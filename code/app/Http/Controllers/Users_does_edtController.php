<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users_does_edt;

class Users_does_edtController extends Controller
{
    //
    public function array_to_date($weeks,$user_id){

        echo date("y M W d w h i s" ,strtotime("now"));
        $weeknumber = (int)date('W') +19;

        $year = "2023";
        $weekY="";
        $dayW ="";


        foreach ($weeks as $week)
        {
            $weekY =$week["week"];
            foreach ($week as $day)
            {
                $dayW =$day["day"]+1;




            }






        }



        return;


    }




}
