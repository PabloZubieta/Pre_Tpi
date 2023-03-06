<?php
/**
 * @file signin.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 24.02.2023
 */
?>
@extends('layout')

@section('content')
    <div>
        <form method="POST" action="/users">
            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
            @method('PUT')
            <div class="mb-3 mt-3">
                <label for="username">Acronyme</label>
                <input type="text"  name="username" placeholder="Acronyme"
                value="{{old('username')}}">
                @error('username')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email"  name="email" placeholder="email"
                       value="{{old('email')}}">
                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>

             <div class="mb-3">
                <label for="place">lieux d'habitation:</label>
                <select id="place" name="place" >
                    @foreach($places as $placed)
                        <option value="{{$placed->id}}">{{$placed->name}}</option>


                    @endforeach

                </select>





                @error('place')
                <p>{{$message}}</p>
                @enderror

            </div>

            <div class="mb-3">
                <label for="car_seat">Place de voiture:</label>
                <input type="number"  name="car_seat" placeholder="Place de voiture"
                       value="{{old('car_seat')}}">
                @error('car_seat')
                <p>{{$message}}</p>
                @enderror
            </div>
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

            <button type="submit" name="sign" class="btn btn-primary">signin</button>
            <button type="reset" class="btn btn-primary" >Annuler </button>


        </form>


    </div>
@endsection
