<?php
/**
 * @file login.blade.php
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
            <div class="mb-3 mt-3">
                <label for="username">Acronyme</label>
                <input type="text"  name="username" placeholder="Acronyme">
                @error('name')
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


            <button type="submit" name="sign" class="btn btn-primary">login</button>
            <button type="reset" class="btn btn-primary" >Annuler </button>


        </form>


    </div>
@endsection
