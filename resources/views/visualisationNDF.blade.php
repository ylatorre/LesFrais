<x-app-layout>
    <x-slot name="header">
    </x-slot>
@if(Auth::user()->admin == 1 && $utilisateurs[0]->admin == 0)
    <div class="w-full h-20 px-4 mb-6 font-bold">Note de frais de {{$utilisateurs[0]->name}} pour le mois : {{$utilisateurs[0]->mois}}
        <div class="flex flex-row justify-around">
            <form method="POST" action="{{route("validerNDF")}}">
                @csrf
                <input type="hidden" name="moisndf" value="{{$utilisateurs[0]->mois}}">
                <input type="hidden" name="username" value="{{$utilisateurs[0]->name}}">
                <button type="submit" class="validerNDF">Valider la note de frais</button>
            </form>
            <form method="POST" action="{{route("supprimerNDF")}}">
                @csrf
                <input type="hidden" name="moisndf" value="{{$utilisateurs[0]->mois}}">
                <input type="hidden" name="username" value="{{$utilisateurs[0]->name}}">
                <button type="submit" class="supprimerNDF">supprimer la note de frais</button>
            </form>

        </div>
    </div>
@elseif(Auth::user()->salarie == 1 || Auth::user()->admin == 1 && Auth::user()->superadmin != 1 )
    <div class="flex flex-row items-center justify-around w-full h-20 px-4 mb-6 font-bold">
        <a href="{{route('dashboard')}}"><x-button>retourner à mon calendrier</x-button></a>
    </div>
    @elseif(Auth::user()->superadmin == 1)
    <div class="w-full h-20 px-4 mb-6 font-bold margin">Note de frais de {{$utilisateurs[0]->name}} pour le mois : {{$utilisateurs[0]->mois}}
        <div class="flex flex-row justify-around items-center">
            <form method="POST" action="{{route('PDFgeneratorPerMonth')}}" id="formndf" target="_blank">
                @csrf
                <input id="inputdate" type="hidden" name="selectedMonth" value="{{$utilisateurs[0]->mois}}">


                <button type="submit" class="validerNDF" target="_blank">Générer et valider la note de
                    frais</button>
            </form>

                <a href="{{route('dashboard')}}"><x-button>retourner à mon calendrier</x-button></a>


        </div>
    </div>
    @endif

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
<div class="w-full flex flex-row justify-around py-5 " style="border:4px solid black;">
    <div class="w-full">
<img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">
<style>
    .TH-table {
        font-size: 15px;
        border: 1px solid black;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
        padding: 2px;
        height: 40px;
    }

    .TD-table {
        font-size: 13px;
        border: 2px solid black;
        padding: 2px;
    }

    .col-table {
        font-size: 13px;
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
    <h1 class="text-center font-bold">Employé : {{$utilisateurs[0]->name}} {{-- PERIODE (année + mois): {{$mois}}--}}</h1>
{{--    <h1 class="">dawd</h1>--}}
<div class="w-full flex flex-row justify-around">
    <div>
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
    <th class="TH-table text-center BGblue" style="border-left: 2px solid black">Dt TVA (20%)</th>
    <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Repas</th>
    <th class="TH-table text-center BGyellow">Hotels</th>
    <th class="TH-table text-center BGyellow">Dt TVA (10%)</th>

    <th class="TH-table text-center BGgreen" style="border-left: 2px solid black">km et taux / km
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
                $totalTVA20 = round(($utilisateur->divers + $utilisateur->peage + $utilisateur->essence+$utilisateur->parking)/1.2*0.2,2) + $totalTVA20;
                $totalTVA10 = round(($utilisateur->repas + $utilisateur->hotel)/1.1*0.1,2) + $totalTVA10;
                $totaltot = 0;
                $totalTVAtot = round(($totalRepas + $totalHotels)*0.1 ,2);

                /* régler le probleme de la tva et du total tva içi*/


            @endphp
            <td class="TD-table text-center BGjour">{{$datedebut[0]}} à {{$datefin[0]}}</td>
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
            <td class="TD-table text-center">{{round(($utilisateur->repas + $utilisateur->hotel)/1.1*0.1,2)}} €</td>

            <td class="col-table text-center" style="border-left: 2px solid black">{{$utilisateur->kilometrage}}km</td>
            <td class="col-table text-center"
                style="border-left: 2px solid black;border-right: 2px solid black; overflow:hidden">{{$utilisateur->description}}</td>

        </tr>

    @endforeach
    @php
        $SousTotalTransport =  $totalDivers + $totalEssence + $totalPeage + $totalParking;
        $SousTotalRepasHotels = $totalRepas + $totalHotels;
        $DtTotalTVAHotelRepasKM = ($SousTotalRepasHotels + ($totalKilometres * $utilisateurs[0]->taux)) - $totalTVAtot;
        $total = round($SousTotalTransport + $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux ,2);
    @endphp
    <tr>
        <td class="BGyellow pt-4 "
            style="border-top: 2px solid black;border-left: 2px solid black;font-size: 10px;white-space:nowrap;">
            missions effectuées: {{count($utilisateurs)}} </td>
        <td class=" BGyellow pl-4 pt-4 " rowspan="1" colspan="3" style="border-top: 2px solid black">Sous Total</td>
        <td class="TD-table text-center bg-slate-400">{{$totalPeage}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalParking}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalEssence}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalDivers}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalTVA20}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalRepas}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalHotels}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalTVA10}} €</td>
        <td class="TD-table text-center bg-slate-400">{{$totalKilometres}} Km</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>

        {{--        <td class="TD-table">{{$totalParking}}</td>--}}
        {{--        <td class="TD-table">{{$totalEssence}}</td>--}}
        {{--        <td class="TD-table">{{$totalDivers}}</td>--}}
    </tr>
    <tr>
        <td class="BGyellow" rowspan="1" colspan="4" style="border-left: 2px solid black"></td>

        <td class="TD-table text-center" colspan="5">{{$SousTotalTransport}} €</td>
        <td class="TD-table text-center" colspan="3">{{$SousTotalRepasHotels}} €</td>
        <td class="TD-table text-center" colspan="1">{{round($totalKilometres * $utilisateurs[0]->taux,2)}} €{{-- * prix de l'essence--}}</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>

    </tr>
    <tr>
        <td class="TD-table BGgris" colspan="4">Dt Total HT</td>
        <td class="TD-table text-center BGgris" colspan="5">{{$SousTotalTransport - $totalTVA20}} €</td>
        <td class="TD-table text-center BGgris" colspan="4">{{round(($SousTotalRepasHotels + ($totalKilometres * $utilisateurs[0]->taux)) - $totalTVA10 , 2)}} €</td>
        <td class="TD-table text-center BGnuit" colspan="1"></td>
    </tr>
    <tr>
        <td class="TD-table BGyellow" colspan="4">Total TTC / A rembourser</td>
        <td class="TD-table text-center" colspan="10" style="font-size: 12px !important">{{$total}} €</td>
    </tr>

    </tbody>


</table>
@foreach ($utilisateurs as $utilisateur)
    {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
@endforeach


<table class="pt-4 mt-5">

    <tbody>
        <tr>
            <td class="TD-table text-center">Taux : {{$utilisateurs[0]->taux}} € / km</td>
        </tr>
    <tr>
        <td class="TD-table text-center">Dt TVA : {{$totalTVA20+$totalTVA10}} €</td>
    </tr>
    <tr>
        <td class="TD-table text-center">Dt TOTAL HT: {{$total - ($totalTVA10 + $totalTVA20)}} €</td>
    </tr>
    </tbody>
</table>
</div>
</div>

</x-app-layout>

