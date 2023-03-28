<?php
/**
 * @file schedule.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 08.03.2023
 */
$week = (int)date('W') +19;
$title ="Ecolopnv-horaire";

function switch_time($time){
    switch ($time){
        case 1:
            return "08h00 <br>
            08h45";
        case 2:
            return "08h50 <br>
            09h35";
        case 3:
            return "09h50 <br>
            10h35";
        case 4:
            return "10h40 <br>
            11h25";
        case 5:
            return "11h30 <br>
            12h15";
        case 6:
            return "12h20 <br>
            13h05";
        case 7:
            return "13h30 <br>
            14h15";
        case 8:
            return "14h20 <br>
            15h05";
        case 9:
            return "15h20 <br>
            16h05";
        case 10:
            return "16h10 <br>
            16h55";
        case 11:
            return "17h00 <br>
            17h45";
        case 12:
            return "17h50 <br>
            18h35";
        case 13:
            return "18h40 <br>
            19h25";
        case 14:
            return "19h30 <br>
            20h15";
        case 15:
            return "20h20 <br>
            21h05";
        case 16:
            return "21h15 <br>
            22h00";
        default:
            return "error";
    }
}
$time = 12;
foreach ($schedules as $schedule){
    if($schedule->heure+$schedule->duree>12){
        $time=$schedule->heure+$schedule->duree;
    }
}

?>

@extends('layout')

@section('content')

    <div class="container col-lg-6 col-md-8 col-sm-12">
        <table class="table-striped">
            <thead>
            <tr>
                <th ></th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
            </tr>
            </thead>
            <tbody>

            @for($i =1; $i <=$time ;$i++)
            <tr id="{{$i}}">
                <td ><?php
                        echo switch_time($i);
                           ?></td>
                @for($j =0; $j <=5 ;$j++)
                    <td id="{{$i.'_'.$j}}" style="border-color: blue"></td>

                    @endfor
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
<script>
    @foreach($schedules as $schedule)

    for ($k =0 ;$k <={{$schedule->duree}}- 1; $k++) {
            <?php if( in_array( $week , $schedule->semaines))
        { ?>
            const time = {{$schedule->heure}} + $k;
            const element = document.getElementById( time+"_{{$schedule->jour}}");
            element.innerHTML = "{{$schedule->codemat}} {{$schedule->classe}}";
            element.style = "background-color: #f2e8cf;color :#bc4749";
            <?php
        } ?>



    }

    @endforeach
</script>
@endsection
