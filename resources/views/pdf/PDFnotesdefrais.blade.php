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
         $totalTVA20 = 0;
         $totalTVA10 = 0;
@endphp
<img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">
<style>
    .TH-table {
        font-size: 10px;
        border: 1px solid black;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
        padding: 2px;
        height: 40px;
    }

    .TD-table {
        font-size: 8px;
        border: 2px solid black;
        padding: 2px;
    }

    .col-table {
        font-size: 8px;
        border: 1px solid black;
        padding: 2px;
    }

    .tablepdf {
        border-collapse: collapse;
    }

    .BGjour {
        background: rgba(255, 187, 0, 0.7);
    }

    .BGyellow {
        background: rgb(255, 251, 0, 0.7);
    }

    .BGblue {
        background: rgba(0, 183, 255, 0.7);
    }

    .BGgreen {
        background: rgba(179, 255, 0, 0.7);
    }

    .BGgris {
        background: rgba(157, 157, 157, 0.7);
    }

    .BGnuit {
        background: black;
    }
</style>
{{--<div class="text-center">--}}
    <h1 class="text-center">Nom : {{$utilisateurs[0]->name}} {{-- PERIODE (année + mois): {{$mois}}--}}</h1>
{{--    <h1 class="">dawd</h1>--}}
{{--</div>--}}
<table class="tablepdf">
    <thead>
    <th class="TH-table text-center BGjour" style="border-left: 2px solid black">Jours</th>
    <th class="TH-table text-center w-20" style="border-left: 2px solid black">Client / Prospect</th>
    <th class="TH-table text-center w-20">Ville</th>
    <th class="TH-table text-center w-15">Code Postal</th>
    {{--            <tr colspan="4">TTC            </tr>--}}

    <th class="TH-table text-center BGblue" style="border-left: 2px solid black;">Péage</th>
    <th class="TH-table text-center BGblue">Parking</th>
    <th class="TH-table text-center BGblue">Essence</th>
    <th class="TH-table text-center BGblue">Divers (sauf hotel)</th>
    <th class="TH-table text-center" style="border-left: 2px solid black">Dt TVA (20%)</th>
    <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Repas</th>
    <th class="TH-table text-center BGyellow">Hotels TTC</th>
    <th class="TH-table text-center BGyellow">Dt TVA (10%)</th>

    <th class="TH-table text-center BGgreen" style="border-left: 2px solid black">KM
    </th>
    <th class="TH-table text-center" style="border-left: 2px solid black;border-right: 2px solid black">description</th>
    </thead>
    <tbody>
    @foreach ($utilisateurs as $utilisateur)
        <tr>
            @php
                $datedebut = explode("T",$utilisateur->start);
                $datefin = explode("T",$utilisateur->end);
            @endphp
            @php

                $totalPeage = $utilisateur->peage+$totalPeage;
                $totalParking = $utilisateur->parking+$totalParking;
                $totalEssence = $utilisateur->essence+$totalEssence;
                $totalDivers = $utilisateur->divers+$totalDivers;
                $totalRepas = $utilisateur->repas+$totalRepas;
                $totalHotels = $utilisateur->hotel+$totalHotels;
                $totalKilometres = $utilisateur->kilometrage+$totalKilometres;
                $totalTVA20 = round(($utilisateur->divers+$utilisateur->peage+$utilisateur->essence+$utilisateur->parking)/1.2*0.2,2) + $totalTVA20;
                $totalTVA10 = round(($utilisateur->repas + $utilisateur->hotel)*0.1,2)+$totalTVA10;
            @endphp
            <td class="TD-table text-center BGjour">{{$datedebut[0] }} à {{$datefin[0]}}</td>
            <td class="TD-table text-center">{{$utilisateur->title}}</td>
            <td class="TD-table text-center">{{$utilisateur->ville}}</td>
            <td class="TD-table text-center">{{$utilisateur->code_postal}}</td>
            <td class="TD-table text-center">{{$utilisateur->peage}} €</td>
            <td class="TD-table text-center">{{$utilisateur->parking}} €</td>
            <td class="TD-table text-center">{{$utilisateur->essence}} €</td>
            <td class="TD-table text-center">{{$utilisateur->divers}} €</td>
            <td class="TD-table text-center">{{round(($utilisateur->divers+$utilisateur->peage+$utilisateur->essence+$utilisateur->parking)/1.2*0.2,2)}} €</td>
            <td class="TD-table text-center">{{$utilisateur->repas}} €</td>
            <td class="TD-table text-center">{{$utilisateur->hotel}} €</td>
            <td class="TD-table text-center">{{$totalTVA10}} €</td>

            <td class="col-table text-center" style="border-left: 2px solid black">{{$utilisateur->kilometrage}}km</td>
            <td class="col-table text-center"
                style="border-left: 2px solid black;border-right: 2px solid black">{{$utilisateur->description}}</td>

        </tr>

    @endforeach
    @php
        $SousTotalTransport =  $totalDivers +$totalEssence +$totalPeage+$totalHotels +$totalParking;
        $SousTotalRepasHotels = $totalRepas +$totalHotels;
        $DtTotalTVAHotelRepasKM = $SousTotalRepasHotels + ($totalKilometres * $utilisateurs[0]->chevauxFiscaux) - $totalTVA10;
        $total = $SousTotalRepasHotels + ($totalKilometres * $utilisateurs[0]->chevauxFiscaux) +  $SousTotalTransport;
    @endphp
    <tr>
        <td class="BGyellow pt-4 "
            style="border-top: 2px solid black;border-left: 2px solid black;font-size: 10px;white-space:nowrap;">
            missions effectuées: {{count($utilisateurs)}} </td>
        <td class=" BGyellow pl-4 pt-4 " rowspan="1" colspan="3" style="border-top: 2px solid black">Sous Total</td>
        <td class="TD-table text-center">{{$totalPeage}} €</td>
        <td class="TD-table text-center">{{$totalParking}} €</td>
        <td class="TD-table text-center">{{$totalEssence}} €</td>
        <td class="TD-table text-center">{{$totalDivers}} €</td>
        <td class="TD-table text-center">{{$totalTVA20}} €</td>
        <td class="TD-table text-center">{{$totalRepas}} €</td>
        <td class="TD-table text-center">{{$totalHotels}} €</td>
        <td class="TD-table text-center">{{$totalTVA10}} €</td>
        <td class="TD-table text-center">{{$totalKilometres}} Km</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>

        {{--        <td class="TD-table">{{$totalParking}}</td>--}}
        {{--        <td class="TD-table">{{$totalEssence}}</td>--}}
        {{--        <td class="TD-table">{{$totalDivers}}</td>--}}
    </tr>
    <tr>
        <td class="BGyellow" rowspan="1" colspan="4" style="border-left: 2px solid black"></td>

        <td class="TD-table text-center" colspan="5">{{$SousTotalTransport}} €</td>
        <td class="TD-table text-center" colspan="3">{{$SousTotalRepasHotels}} €</td>
        <td class="TD-table text-center" colspan="1">{{$totalKilometres * $totalEssence}} €{{-- * prix de l'essence--}}</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>

    </tr>
    <tr>
        <td class="TD-table BGgris" colspan="4">Dt Total HT</td>
        <td class="TD-table text-center BGgris" colspan="5">{{$SousTotalTransport - $totalTVA20}} €</td>
        <td class="TD-table text-center BGgris" colspan="4">{{$DtTotalTVAHotelRepasKM}} €</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>
    </tr>
    <tr>
        <td class="TD-table BGyellow" colspan="4">Total TTC / A rembourser</td>
        <td class="TD-table text-center" colspan="10">{{$total}} €</td>
    </tr>

    </tbody>


</table>
@foreach ($utilisateurs as $utilisateur)
    {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
@endforeach


<table class="pt-4">

    <tbody>
    <tr>
        <td class="TD-table text-center">Dt TVA : {{$totalTVA20+$totalTVA10}}</td>
    </tr>
    <tr>
        <td class="TD-table text-center">Dt TOTAL HT: {{$total - $totalTVA10 - $totalTVA20}}</td>
    </tr>
    </tbody>
</table>

<div class="text-sm pt-4">Virement Bancaire</div>
<div class="text-sm">Le .. / .. / ....</div>


</body>

</html>
