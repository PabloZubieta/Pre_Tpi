<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    //
    public function display(){


        $schedules = Schedule::where('abrev', auth()->user()->username)->get();
        return view('schedule',['schedules'=>$schedules]);


    }
}
