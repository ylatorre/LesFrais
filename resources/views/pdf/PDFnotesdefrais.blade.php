<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>


</head>

<body>
@php
    // initialisation des variables
         $totalPeage = 0;
         $totalEssence = 0;
         $totalDivers = 0;
         $totalParking = 0;
         $totalRepas= 0;
         $totalHotels= 0;
         $totalKilometres = 0;
         $SousTotalTransport = 0;
         $SousTotalRepasHotels = 0;
@endphp
<img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">
<style>
    .TH-table {
        font-size: 10px;
        border: 2px solid black;
        padding: 2px;
        height: 40px;
    }

    .TD-table {
        font-size: 8px;
        border: 2px solid black;
        padding: 2px;
    }

    .tablepdf {
        border: collapse;
    }

    .BGjour {
        background: rgba(255, 187, 0, 0.7);
    }

    .BGyellow {
        background: rgb(255, 251, 0, 0.7);
    }

    .BGnuit {
        background: black;
    }
</style>
<table class="tablepdf">
    <thead>
    <th class="TH-table text-center BGjour">Jours</th>
    <th class="TH-table text-center w-20">Client / Porspect</th>
    <th class="TH-table text-center w-20">Ville</th>
    <th class="TH-table text-center w-15">Code Postal</th>
    {{--            <tr colspan="4">TTC            </tr>--}}

    <th class="TH-table text-center">Péage</th>
    <th class="TH-table text-center">Parking</th>
    <th class="TH-table text-center">Essence</th>
    <th class="TH-table text-center">Divers (sauf hotel)</th>
    <th class="TH-table text-center">Dt TVA (20%)</th>
    <th class="TH-table text-center BGyellow">Repas</th>
    <th class="TH-table text-center BGyellow">Hotels TTC</th>
    <th class="TH-table text-center BGyellow">Dt TVA (10%)</th>

    <th class="TH-table ">KM / indémnité</th>
    </thead>
    <tbody>
    @foreach ($utilisateurs as $utilisateur)
        <tr>
            <td class="TD-table text-center BGjour">{{$utilisateur->start}} à {{$utilisateur->end}}</td>
            <td class="TD-table text-center">{{$utilisateur->title}}</td>
            <td class="TD-table text-center">{{$utilisateur->ville}}</td>
            <td class="TD-table text-center">{{$utilisateur->code_postal}}</td>
            <td class="TD-table text-center">{{$utilisateur->peage}}</td>
            <td class="TD-table text-center">{{$utilisateur->parking}}</td>
            <td class="TD-table text-center">{{$utilisateur->essence}}</td>
            <td class="TD-table text-center">{{$utilisateur->divers}}</td>
            <td class="TD-table text-center">Dt TVA (20%)</td>
            <td class="TD-table text-center">{{$utilisateur->repas}}</td>
            <td class="TD-table text-center">{{$utilisateur->hotel}}</td>
            <td class="TD-table text-center">Dt TVA (10%)</td>

            <td class="TD-table">{{$utilisateur->kilometrage}}</td>

        </tr>
        @php

            $totalPeage = $utilisateur->peage+$totalPeage;
            $totalParking = $utilisateur->parking+$totalParking;
            $totalEssence = $utilisateur->essence+$totalEssence;
            $totalDivers = $utilisateur->divers+$totalDivers;
            $totalRepas = $utilisateur->repas+$totalRepas;
            $totalHotels = $utilisateur->hotel+$totalHotels;
            $totalKilometres = $utilisateur->kilometrage+$totalKilometres;
        @endphp
    @endforeach
    @php
        $SousTotalTransport =  $totalDivers +$totalEssence +$totalPeage+$totalHotels;
        $SousTotalRepasHotels = $totalRepas +$totalHotels;
    @endphp
    <tr>
        <td class="TD-table BGjour" rowspan="2" colspan="4">Sous Total</td>
        <td class="TD-table text-center">{{$totalPeage}}</td>
        <td class="TD-table text-center">{{$totalParking}}</td>
        <td class="TD-table text-center">{{$totalEssence}}</td>
        <td class="TD-table text-center">{{$totalDivers}}</td>
        <td class="TD-table text-center">calculer la tva 20</td>
        <td class="TD-table text-center">{{$totalRepas}}</td>
        <td class="TD-table text-center">{{$totalHotels}}</td>
        <td class="TD-table text-center">calculer la tva 10</td>
        <td class="TD-table text-center">{{$totalHotels}}</td>

        {{--        <td class="TD-table">{{$totalParking}}</td>--}}
        {{--        <td class="TD-table">{{$totalEssence}}</td>--}}
        {{--        <td class="TD-table">{{$totalDivers}}</td>--}}
    </tr>
    <tr>
        <td class="TD-table text-center" colspan="5">{{$SousTotalTransport}}</td>
        <td class="TD-table text-center" colspan="3">{{$SousTotalRepasHotels}}</td>
        <td class="TD-table text-center" colspan="1">{{$totalKilometres}}</td>

    </tr>
{{--    <h1>{{$totalPeage}}</h1>--}}
{{--    <h1>{{$totalParking}}</h1>--}}
{{--    <h1>{{$totalEssence}}</h1>--}}
{{--    <h1>{{$totalDivers}}</h1>--}}
    </tbody>


</table>
@foreach ($utilisateurs as $utilisateur)
    {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
@endforeach


</body>

</html>
