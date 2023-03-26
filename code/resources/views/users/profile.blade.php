<?php
/**
 * @file profile.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 08.03.2023
 */
$title ="Ecolopnv-profil";
?>


@extends('layout')

@section('content')

    <div class="container " style="padding-top: 20px;padding-bottom: 30px">

        <div class="row" >
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                        <h5>Username :
                        </h5>
                        <p>{{auth()->user()->username}}</p>

                </div>
                <div>
                    <div>
                        <h5>Last name :
                        </h5>
                        <p>{{auth()->user()->last_name}}</p>
                    </div>
                </div>
                <div>
                    <div>
                        <h5>Email :</h5>
                        <p>{{auth()->user()->email}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <div>
                    <form method="POST" action="/actualise">
                        @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <h5>Place :</h5>
                                <p id="pla1" >{{$user_place}}</p>
                            </div>
                            <div class="col-6" >
                                <img src="pencil.png" onclick="hide_show('pla')" style="background-color: green;float: right;width: 20px;height: 20px;border-radius: 15%">
                            </div>


                        </div>
                        <div id="pla" class="mb-3" style="display: none">

                            <select id="place"  class="form-control" name="place" >
                                @foreach($places as $placed)
                                    <option value="{{$placed->id}}"
                                            @if($placed->id == auth()->user()->place_id)
                                                selected
                                        @endif

                                    >{{$placed->name}}</option>


                                @endforeach

                            </select>

                            @error('place')
                            <p>{{$message}}</p>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <h5>Carseat :</h5>
                                <p id="car1">{{auth()->user()->car_seat}}</p>
                            </div>
                            <div class="col-6 " >
                                <img  src="pencil.png" onclick="hide_show('car')" style="background-color: green;float: right;width: 20px;height: 20px;border-radius: 15%">
                            </div>

                        </div>
                        <div id="car" class="mb-3" style="display: none">

                            <input type="number"  class="form-control" name="car_seat" placeholder="Place de voiture"
                                   value="{{auth()->user()->car_seat}}">
                            @error('car_seat')
                            <p>{{$message}}</p>
                            @enderror
                        </div>

                        <!--<div>
                            <button onclick="hide_show('pass')">Edit pwd </button>
                        </div>
                        <div id="pass" style="display: none" >
                            <div class="mb-3">
                                <label for="password">Mot de passe:</label>
                                <input type="password"  name="password" placeholder="Mot de passe">
                                @error('password')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Comfirmer le mot de passe:</label>
                                <input type="password"  name="password_confirmation" placeholder="confirmation de mdp">
                                @error('password_confirmation')
                                <p>{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        -->

                        <div id="submit" style="display: none">
                            <button type="submit" name="sign" class="btn btn-primary">validate</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>




    </div>



    <script>
function hide_show(elem)
{
    if((document.getElementById(elem).style.display) =="none")
    {
        document.getElementById(elem).style.display ="block";
        document.getElementById("submit").style.display ="block";

        if(elem!=="pass"){
            document.getElementById(elem+"1").style.display ="none";
        }

    }
    else {
        document.getElementById(elem).style.display ="none";

        if(elem!=="pass"){
            document.getElementById(elem+"1").style.display ="block";
        }
    }

}


    </script>
@endsection
