<?php
/**
 * @file carpooling.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 23.03.2023
 */
$title ="Ecolopnv-covoit";
?>




@extends('layout')

@section('content')
    <div class="container " style="margin: 3px;padding-top: 20px;padding-bottom: 30px">

        <div class="row" >
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h4 style=" text-align: center">Next carpooling</h4>
                @if($nextcarpooling->isEmpty())
                    <div>
                        <p>aucun covoiturage de prevu</p>
                    </div>
                @else
                    <div class="row">
                        <div class="col-6 ">
                            <p>time: {{$nextcarpooling[0]->carpooling_time}} </p>
                            <p>place: {{$nextcarpooling[0]->name}}</p>
                            <p>driver:
                                @if($nextcarpooling[0]->driver_id==auth()->user()->username)
                                    YOU
                                @else
                                    {{$nextcarpooling[0]->driver_id}}
                                @endif
                                </p>
                        </div>
                        <div class="col-6 ">
                            <p>
                                passenger
                            </p>
                            <table class="table table-striped">
                                @foreach($nextcarpooling as $nextcarpoolin)
                                    <tr>
                                        <td>
                                            @if($nextcarpoolin->username==auth()->user()->username)
                                                YOU
                                            @else
                                                {{$nextcarpoolin->username}}
                                            @endif</td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <h4 style=" text-align: center">Last taken carpooling</h4>
                @if($lasttaken->isEmpty())
                    <div>
                        <p>Aucun covoiturage pris</p>
                    </div>
                @else
                    <div class="row">
                        <div class="col-6 ">
                            <p>time: {{$lasttaken[0]->carpooling_time}} </p>
                            <p>place: {{$lasttaken[0]->name}}</p>
                            <p>driver: {{$lasttaken[0]->driver_id}}</p>
                        </div>
                        <div class="col-6 ">
                            <p>
                                passenger
                            </p>
                            <table class="table table-striped">
                                @foreach($lasttaken as $lasttake)
                                    <tr>
                                        <td>
                                            @if($lasttake->username==auth()->user()->username)
                                                YOU
                                            @else
                                                {{$lasttake->username}}
                                            @endif
                                            </td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="row" >
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h4 style=" text-align: center">Validate</h4>
                <div class="row">
                    <div class="col-6 ">
                        <form  method="POST" action="/validate">
                            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
                            @method('PUT')
                            <div class="mb-3">
                                <input type="number"  name="conf"  value="1" hidden >
                            </div>
                            <div id="submit" >
                                <button type="submit" name="Validate" class="btn btn-primary col-12">validate</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6 ">
                        <form  method="POST" action="/validate">
                            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
                            @method('PUT')
                            <div class="mb-3">
                                <input type="number"  name="conf"  value="0" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="number"  name="conf"  value="0" hidden>
                            </div>
                            <div id="submit" >

                                <button type="submit" name="Validate" class="btn btn-primary col-12">reject</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <h4 style=" text-align: center">Last driven carpooling</h4>
                @if($lastdriven->isEmpty())
                    <div>
                        <p>aucun covoiturage conduit</p>
                    </div>
                @else
                    <div class="row">
                        <div class="col-6 ">
                            <p>time: {{$lastdriven[0]->carpooling_time}} </p>
                            <p>place: {{$lastdriven[0]->name}}</p>
                        </div>
                        <div class="col-6 ">
                            <p>
                                passenger
                            </p>
                            <table class="table table-striped">
                                @foreach($lastdriven as $lastdrive)
                                    <tr>
                                        <td>{{$lastdrive->username}}</td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>



    </div>
@endsection
