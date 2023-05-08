<?php
/**
 * @file home.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 22.02.2023
 */
$title ="Ecolopnv";
?>
@extends('layout')

@section('content')
    <div style="padding:5px;">
        <div class="container col-lg-6 col-md-8 col-sm-12 " style="background-color: #386641; border-radius: 10px; color: #F2EBCF;padding-top: 20px;padding-bottom: 30px">
            <h2 style=" text-align: center;padding-bottom: 15px">Bienvenu sur Ecolopnv</h2>
            <div class="row" >
                <div class="col-lg-6 col-md-12 col-sm-12"><p>
                        Vous voyez le réchauffement climatique s'intensifier, les gouvernements prendre des décisions irresponsables, la sixième extinction de masse arriver, des guerres éclater, la démocratie reculer, des chaines d'approvisionnement être mises en péril?</p></div>
                <div class="col-lg-6 col-md-12 col-sm-12" ><p>
                        Ne dites pas un mot de plus! Ecolopnv est là pour vous.<br>
                        Certes, ce site[?] ne vous permettra pas d'avoir une influence significative sur tous ces problèmes... mais il aura le mérite de vous donner bonne conscience. Hé oui, vous, au moins, vous ferez du covoiturage. Vous pourrez ainsi continuer de moraliser les autres conducteurs, et vous prélasser dans la plus grande auto-satisfaction.</p></div>
            </div>



        </div>

    </div>











    <style>

        .timeline_area {
            position: relative;
            z-index: 1;
        }
        .single-timeline-area {
            position: relative;
            z-index: 1;
            padding-left: 180px;
        }
        @media only screen and (max-width: 575px) {
            .single-timeline-area {
                padding-left: 100px;
            }
        }
        .single-timeline-area .timeline-date {
            position: absolute;
            width: 180px;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -ms-grid-row-align: center;
            align-items: center;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
            padding-right: 60px;
        }
        @media only screen and (max-width: 575px) {
            .single-timeline-area .timeline-date {
                width: 100px;
            }
        }
        .single-timeline-area .timeline-date::after {
            position: absolute;
            width: 3px;
            height: 100%;
            content: "";
            background-color: #ebebeb;
            top: 0;
            right: 30px;
            z-index: 1;
        }
        .single-timeline-area .timeline-date::before {
            position: absolute;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background-color: #1D72AF;
            content: "";
            top: 50%;
            right: 26px;
            z-index: 5;
            margin-top: -5.5px;
        }
        .single-timeline-area .timeline-date p {
            margin-bottom: 0;
            color: #020710;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .single-timeline-area .single-timeline-content {
            position: relative;
            z-index: 1;
            padding: 30px 30px 25px;
            border-radius: 6px;
            margin-bottom: 15px;
            margin-top: 15px;
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            border: 1px solid #ebebeb;
        }
        @media only screen and (max-width: 575px) {
            .single-timeline-area .single-timeline-content {
                padding: 20px;
            }
        }
        .single-timeline-area .single-timeline-content .timeline-icon {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            width: 30px;
            height: 30px;
            background-color: #1D72AF;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 30px;
            flex: 0 0 30px;
            text-align: center;
            max-width: 30px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .single-timeline-area .single-timeline-content .timeline-icon i {
            color: #ffffff;
            line-height: 30px;
        }
        .single-timeline-area .single-timeline-content .timeline-text h6 {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
        }
        .single-timeline-area .single-timeline-content .timeline-text p {
            font-size: 13px;
            margin-bottom: 0;
        }
        .single-timeline-area .single-timeline-content:hover .timeline-icon,
        .single-timeline-area .single-timeline-content:focus .timeline-icon {
            background-color: #020710;
        }
        .single-timeline-area .single-timeline-content:hover .timeline-text h6,
        .single-timeline-area .single-timeline-content:focus .timeline-text h6 {
            color: #3f43fd;
        }

    </style>


@endsection
