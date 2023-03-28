<?php
/**
 * @file signin.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 24.02.2023
 */
$title ="Ecolopnv-inscription";
?>
@extends('layout')

@section('content')
    <div class="container mt-3 col-lg-6 col-md-8 col-sm-12">
        <form method="POST" action="/users">
            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
            @method('PUT')
            <div class="mb-3 mt-3">
                <label for="username">Acronyme:</label>
                <input type="text" class="form-control" name="username" placeholder="Acronyme"
                value="{{old('username')}}">
                @error('username')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="email"
                       value="{{old('email')}}">
                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="place">lieux d'habitation:</label>
                <select id="place" class="form-control" name="place" >
                    @foreach($places as $placed)
                        <option value="{{$placed->id}}"
                                @if($placed->id==old('place'))
                                    selected
                                    @endif

                        >{{$placed->name}}</option>


                    @endforeach

                </select>





                @error('place')
                <p>{{$message}}</p>
                @enderror

            </div>

            <div class="mb-3">
                <label for="car_seat">Place de voiture:</label>
                <input type="number" class="form-control"  name="car_seat" placeholder="Place de voiture"
                       value="{{old('car_seat')}}">
                @error('car_seat')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                @error('password')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation">Comfirmer le mot de passe:</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="confirmation de mdp">
                @error('password_confirmation')
                <p>{{$message}}</p>
                @enderror
            </div >
            <div class="mb-3 row">

                <button type="submit" name="sign" class="btn btn-primary col-5" style="background-color: #a7c957;color:#bc4749;border:#386641">signin</button>
                <div class="col-2"></div>

                <button type="reset" class="btn btn-primary col-5" style="background-color: #a7c957;color:#bc4749;border:#386641">Annuler </button>
            </div>



        </form>


    </div>
@endsection
