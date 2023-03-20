<?php
/**
 * @file profile.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 08.03.2023
 */
?>


@extends('layout')

@section('content')

    <div>
        <div>
            <h4>Username :
            </h4>
            <p>{{auth()->user()->username}}</p>
        </div>
    </div>
    <div>
        <div>
            <h4>Last name :
            </h4>
            <p>{{auth()->user()->last_name}}</p>
        </div>
    </div>
    <div>
        <div>
            <h4>Email :
            </h4>
            <p>{{auth()->user()->email}}</p>
        </div>
    </div>
    <div>
        <form method="POST" action="/users">
            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
            @method('PUT')

            <div>
                <p>place: {{$user_place}}</p>
                <button onclick="hide_show('pla')">place </button>
            </div>
            <div id="pla" class="mb-3" style="display: none">
                <label for="place">lieux d'habitation:</label>
                <select id="place" name="place" >
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

            <div>
                <p>carseat: {{auth()->user()->car_seat}}</p>
                <button onclick="hide_show('car')">car </button>
            </div>
            <div id="car" class="mb-3" style="display: none">
                <label for="car_seat">Place de voiture:</label>
                <input type="number"  name="car_seat" placeholder="Place de voiture"
                       value="{{auth()->user()->car_seat}}">
                @error('car_seat')
                <p>{{$message}}</p>
                @enderror
            </div>

            <div>
            <button onclick="hide_show('pass')">pass </button>
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

            <div id="submit" style="display: none">
                <button type="submit" name="sign" class="btn btn-primary">validate</button>
            </div>


        </form>

    </div>
    <script>
function hide_show(elem)
{
    if((document.getElementById(elem).style.display) =="none")
    {
        document.getElementById(elem).style.display ="block";
        document.getElementById("submit").style.display ="block"
    }
    else {
        //document.getElementById(elem).style.display ="none";
    }

}


    </script>
@endsection
