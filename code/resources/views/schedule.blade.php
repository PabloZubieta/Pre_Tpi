<?php
/**
 * @file schedule.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 08.03.2023
 */
$week = (int)date('W') +19;

?>


@extends('layout')

@section('content')

    <div>
        <table >
            <tr>
                <td ></td>
                <td>Lundi</td>
                <td>Mardi</td>
                <td>Mercredi</td>
                <td>Jeudi</td>
                <td>Vendredi</td>
                <td>Samedi</td>
            </tr>

            @for($i =1; $i <=12 ;$i++)
            <tr id="{{$i}}">
                <td ><?php
                        $heure = 8 +(int)(($i-1)*50/60);
                        $minutes = ($i-1)*50%60;
                        echo $heure.'h'.$minutes;
                           ?></td>
                @for($j =0; $j <=5 ;$j++)
                    <td id="{{$i.'_'.$j}}" style="border-color: blue"></td>

                    @endfor
            </tr>
            @endfor


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
            element.style = "background-color: pink";
            <?php
        } ?>



    }

    @endforeach
</script>
@endsection
