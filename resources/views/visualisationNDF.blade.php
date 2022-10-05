<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <x-slot name="header">
    </x-slot>
    @if (Auth::user()->admin == 1 && $utilisateurs[0]->admin == 0)

        @if (explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre')
            <div class="w-full h-20 px-4 mb-6 font-bold text-center">Prévisualisation de la note de frais de {{ $utilisateurs[0]->name }} pour le mois
                d'{{ $dateNDFpourPDFetVISU }}
            @else
                <div class="w-full h-20 px-4 mb-6 font-bold text-center">Prévisualisation de la note de frais de {{ $utilisateurs[0]->name }} pour le mois
                    de {{ $dateNDFpourPDFetVISU }}
        @endif
        <div class="flex flex-row justify-around">
            <form method="POST" action="{{ route('validerNDF') }}">
                @csrf
                <input type="hidden" name="moisndf" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="username" value="{{ $utilisateurs[0]->name }}">
                <button type="submit" class="validerNDF">Valider la note de frais</button>
            </form>
            <form method="POST" action="{{ route('supprimerNDF') }}">
                @csrf
                <input type="hidden" name="moisndf" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="username" value="{{ $utilisateurs[0]->name }}">
                <button type="submit" class="supprimerNDF">supprimer la note de frais</button>
            </form>

        </div>
        </div>
    @elseif(Auth::user()->salarie == 1 || (Auth::user()->admin == 1 && Auth::user()->superadmin != 1))
        <div class="flex flex-row items-center justify-around w-full h-20 px-4 mb-6 font-bold">
            <a href="{{ route('dashboard') }}"><button type="submit" class="validerNDF">retourner à mon
                    calendrier</button></a>
        </div>
    @elseif(Auth::user()->superadmin == 1)
        @if (explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
            explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre')
            <div class="w-full h-20 px-4 mb-6 font-bold text-center">Prévisualisation de la note de frais de {{ $utilisateurs[0]->name }} pour le mois
                d'{{ $dateNDFpourPDFetVISU }}
            @else
                <div class="w-full h-20 px-4 mb-6 font-bold text-center">Prévisualisation de la note de frais de {{ $utilisateurs[0]->name }} pour le mois
                    de {{ $dateNDFpourPDFetVISU }}
        @endif
        <div class="flex flex-row justify-around items-center">
            <form method="POST" action="{{ route('PDFgeneratorPerMonth') }}" id="formndf" target="_blank">
                @csrf
                <input id="inputdate" type="hidden" name="selectedMonth" value="{{ $utilisateurs[0]->mois }}">
                <input type="hidden" name="idUser" value="{{ $utilisateurs[0]->idUser }}">


                <button type="submit" class="validerNDF" target="_blank">Valider et générer la note de
                    frais</button>
            </form>

            <a href="{{ route('dashboard') }}"><button type="submit" class="validerNDF">retourner à mon
                    calendrier</button></a>


        </div>
        </div>
    @endif

    @php
        // initialisation des variables
        $totalPeage = 0;
        $totalEssence = 0;
        $totalDivers = 0;
        $totalParking = 0;
        $totalRepas = 0;
        $totalHotels = 0;
        $totalKilometres = 0;
        $SousTotalTransport = 0;
        $SousTotalRepasHotels = 0;
        $totalTVA20 = 0;
        $totalTVA10 = 0;
    @endphp
    <style>
        .TH-table {
            font-size: 15px;
            border: 1px solid black;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            padding-left: 2px;
            padding-right: 2px;
            height: 40px;
        }

        .TD-table {
            font-size: 13px;
            border: 2px solid black;
            padding-left: 2px;
            padding-right: 2px;
        }

        .col-table {
            font-size: 13px;
            border: 1px solid black;
            padding-left: 2px;
            padding-right: 2px;
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


        .td-top-table {
            border: 2px solid black;
            padding: 2px;
            text-align: center;
            font-size: 12px;
        }

        /* -- Responsive du site */
        @media screen and (max-width:1400px) {

            /* responsive sous les 1400px*/
            .mission-effectuees {
                font-size: 10px;
            }

            .td-top-table {
                font-size: 12px;
            }

            .TH-table {
                font-size: 10px;
                padding: 1px;
            }

            .TD-table {
                font-size: 8px;
                padding: 1px;
            }

            .td-sous-total {
                font-size: 11px;
            }
        }

        @media screen and (max-width:960px) {

            /*responsive sous-les 960px*/
            .mission-effectuees {
                font-size: 8px;
            }

            .td-top-table {
                font-size: 10px;
            }

            .TH-table {
                font-size: 8px;

            }

            .TD-table {
                font-size: 6px;

            }

            .td-sous-total {
                font-size: 9px;
            }

            .validerNDF {
                padding: 0.5rem;
                border: 4px solid rgb(0, 151, 0);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 12px;
                transition: 100ms ease-in;
            }

            .supprimerNDF {
                padding: 0.6rem;
                border: 4px solid rgb(155, 11, 11);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 12px;
                transition: 100ms ease-in;
            }

            .validerNDF:hover {
                transform: scale(1.05);
            }

            .supprimerNDF:hover {
                transform: scale(1.05);
            }
        }

        @media screen and (max-width:700px) {

            /*responsive sous-les 700px*/
            .mission-effectuees {
                font-size: 7px;
            }

            .td-top-table {
                font-size: 9px;
            }

            .TD-table-tot {
                font-size: 7px;
            }

            .TH-table {
                font-size: 6px;

            }

            .TD-table {
                font-size: 4px;

            }

            .td-sous-total {
                font-size: 7px;
            }

            .validerNDF {

                border: 4px solid rgb(0, 151, 0);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 10px;
                transition: 100ms ease-in;
            }

            .supprimerNDF {

                border: 4px solid rgb(155, 11, 11);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 10px;
                transition: 100ms ease-in;
            }

            .validerNDF:hover {
                transform: scale(1.05);
            }

            .supprimerNDF:hover {
                transform: scale(1.05);
            }

        }

        @media screen and (max-width:500px) {

            /* responsive sous le seuil des 500px*/
            .mission-effectuees {
                font-size: 6px;
            }

            .td-top-table {
                font-size: 8px;
            }

            .TD-table-tot {
                font-size: 6px;
            }

            .TH-table {
                font-size: 5px;

            }

            .TD-table {
                font-size: 5px;

            }

            .td-sous-total {
                font-size: 6px;
            }

            .validerNDF {

                border: 2px solid rgb(0, 151, 0);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 8px;
                transition: 100ms ease-in;
            }

            .supprimerNDF {

                border: 2px solid rgb(155, 11, 11);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 8px;
                transition: 100ms ease-in;
            }

            .validerNDF:hover {
                transform: scale(1.05);
            }

            .supprimerNDF:hover {
                transform: scale(1.05);
            }
        }

        @media screen and (max-width:400px) {

            /* responsive sous le seuil des 400px*/
            .mission-effectuees {
                font-size: 4px;
            }

            .td-top-table {
                font-size: 6px;
            }

            .TD-table-tot {
                font-size: 4px;
            }

            .TD-table {
                font-size: 5px;

            }

            .td-sous-total {
                font-size: 5px;
            }

            .validerNDF {

                border: 2px solid rgb(0, 151, 0);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 8px;
                transition: 100ms ease-in;
            }

            .supprimerNDF {

                border: 2px solid rgb(155, 11, 11);
                background: #202020 !important;
                color: white;
                font-family: 'nunito', sans-serif;
                font-weight: bold;
                font-size: 8px;
                transition: 100ms ease-in;
            }

            .validerNDF:hover {
                transform: scale(1.05);
            }

            .supprimerNDF:hover {
                transform: scale(1.05);
            }
        }
    </style>
    <div class="w-full flex flex-row justify-around py-5 " style="border:4px solid black;">
        <div class="w-full">
        <div class="w-full flex items-center justify-around mb-5">
            <div class="flex flex-row">
            <img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">


            <table style="margin-left:10px; border:2px solid black; margin-top:1%; margin-bottom:1%;">
                <tr>
                    <td class="td-top-table">Prénom / Nom :</td>
                    <td class="td-top-table">{{ $utilisateurs[0]->name }}</td>
                </tr>
                <tr>
                    <td class="td-top-table">Frais de:</td>
                    <td class="td-top-table">{{ $dateNDFpourPDFetVISU }}</td>
                </tr>

            </table>
        </div>
        </div>

            {{--    <h1 class="">dawd</h1> --}}
            <div class="w-full flex flex-row justify-around items-center">
                <div>
                    <table class="tablepdf">
                        <thead>
                            <th class="TH-table text-center BGjour" style="border-left: 2px solid black">Jours</th>
                            <th class="TH-table text-center " style="border-left: 2px solid black">Client / Prospect
                            </th>
                            <th class="TH-table text-center ">Code Postal</th>
                            <th class="TH-table text-center ">Ville</th>
                            <th class="TH-table text-center"
                                style="width:5% !important; overflow:hidden; border-left: 2px solid black;border-right: 2px solid black">
                                description</th>
                            {{--            <tr colspan="4">TTC            </tr> --}}

                            <th class="TH-table text-center BGblue" style="border-left: 2px solid black;">Péage</th>
                            <th class="TH-table text-center BGblue">Parking</th>
                            <th class="TH-table text-center BGblue">Essence</th>
                            <th class="TH-table text-center BGblue">Divers</th>
                            <th class="TH-table text-center BGblue" style="border-left: 2px solid black">Dt TVA
                                (20%)
                            </th>
                            <th class="TH-table text-center BGyellow" style="border-left: 2px solid black">Repas
                            </th>
                            <th class="TH-table text-center BGyellow">Hotels</th>
                            <th class="TH-table text-center BGyellow">Dt TVA (10%)</th>

                            <th class="TH-table text-center BGgreen" style="border-left: 2px solid black">km et
                                {{ $utilisateurs[0]->taux }} /
                                km
                            </th>

                        </thead>
                        <tbody>
                            @foreach ($utilisateurs as $utilisateur)
                                <tr>
                                    @php
                                        // - formatage de la date de début
                                        $dateFormatedStart = explode('-', $utilisateur->start);
                                        $dayStart = explode(' ', $dateFormatedStart[2]);
                                        $datedebut = $dayStart[0] . '-' . $dateFormatedStart[1] . '-' . $dateFormatedStart[0] . ' ' . $dayStart[1];

                                        // - formatage de la date de fin
                                        $dateFormatedEnd = explode('-', $utilisateur->end);
                                        $dayEnd = explode(' ', $dateFormatedEnd[2]);
                                        $datefin = $dayStart[0] . '-' . $dateFormatedEnd[1] . '-' . $dateFormatedEnd[0] . ' ' . $dayEnd[1];
                                    @endphp
                                    @php

                                        $totalPeage = $utilisateur->peage + $totalPeage;
                                        $totalParking = $utilisateur->parking + $totalParking;
                                        $totalEssence = $utilisateur->essence + $totalEssence;
                                        $totalDivers = $utilisateur->divers + $totalDivers;
                                        $totalRepas = $utilisateur->repas + $totalRepas;
                                        $totalHotels = $utilisateur->hotel + $totalHotels;
                                        $totalKilometres = $utilisateur->kilometrage + $totalKilometres;
                                        $totalTVA20 = round((($utilisateur->divers + $utilisateur->peage + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) + $totalTVA20;
                                        $totalTVA10 = round((($utilisateur->repas + $utilisateur->hotel) / 1.1) * 0.1, 2) + $totalTVA10;
                                        $totaltot = 0;
                                        $totalTVAtot = round(($totalRepas + $totalHotels) * 0.1, 2);

                                        /* régler le probleme de la tva et du total tva içi*/

                                    @endphp
                                    <td class="TD-table text-center BGjour pl-1 pr-1">du {{ $datedebut }}<br> au
                                        {{ $datefin }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->title }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->code_postal }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->ville }}</td>
                                    <td class="TD-table col-table text-center"
                                        style=" max-width:120px; overflow:hidden; border-bottom:2px solid black">
                                        {{ $utilisateur->description }}</td>
                                    <td class="TD-table text-center">{{ $utilisateur->peage }} €</td>
                                    <td class="TD-table text-center">{{ $utilisateur->parking }} €</td>
                                    <td class="TD-table text-center">{{ $utilisateur->essence }} €</td>
                                    <td class="TD-table text-center">{{ $utilisateur->divers }} €</td>
                                    <td class="TD-table text-center">
                                        {{ round((($utilisateur->divers + $utilisateur->peage + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) }}
                                        €</td>
                                    <td class="TD-table text-center">{{ $utilisateur->repas }} €</td>
                                    <td class="TD-table text-center">{{ $utilisateur->hotel }} €</td>
                                    <td class="TD-table text-center">
                                        {{ round((($utilisateur->repas + $utilisateur->hotel) / 1.1) * 0.1, 2) }} €
                                    </td>

                                    <td class="TD-table col-table text-center" style="border-left: 2px solid black">
                                        {{ $utilisateur->kilometrage }} km</td>


                                </tr>
                            @endforeach
                            @php
                                $SousTotalTransport = $totalDivers + $totalEssence + $totalPeage + $totalParking;
                                $SousTotalRepasHotels = $totalRepas + $totalHotels;
                                $DtTotalTVAHotelRepasKM = $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux - $totalTVAtot;
                                $total = round($SousTotalTransport + $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux, 2);
                            @endphp
                            <tr>
                                <td class="BGyellow pl-1" style="border:2px solid black; font-size:10px;"
                                    colspan="2">Taux :
                                    {{ $utilisateurs[0]->taux }} € / km</td>


                                @if (count($infosNDF) == 0)
                                    <td class="BGyellow pl-1" colspan="3"
                                        style="border:2px solid black; font-size:10px;">Pas encore soumise</td>
                                @else
                                    <td class="BGyellow pl-1" colspan="3"
                                        style="border:2px solid black; font-size:10px;">Soumise le :
                                        {{ $infosNDF[0]->DateSoumission }}</td>
                                @endif



                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalPeage }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalParking }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalEssence }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalDivers }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalTVA20 }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalRepas }} €</td>
                                <td class="TD-table text-center" style="background: rgb(175, 175, 175) !important;">
                                    {{ $totalHotels }} €</td>
                                <td class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important; border-bottom:2px solid red;">
                                    {{ $totalTVA10 }} €</td>
                                <td class="TD-table text-center"
                                    style="background: rgb(175, 175, 175) !important; border-bottom:2px solid red;">
                                    {{ $totalKilometres }} Km</td>


                                {{--        <td class="TD-table">{{$totalParking}}</td> --}}
                                {{--        <td class="TD-table">{{$totalEssence}}</td> --}}
                                {{--        <td class="TD-table">{{$totalDivers}}</td> --}}
                            </tr>
                            <tr>
                                <td class="BGyellow pl-1" rowspan="1" colspan="2"
                                    style="border-left: 2px solid black; font-size:10px;">TVA :
                                    {{ $totalTVA20 + $totalTVA10 }} €
                                </td>
                                @if (count($infosNDF) == 0)
                                    <td class="BGyellow pl-1" colspan="3"
                                        style="border:2px solid black; font-size:10px;">Pas encore soumise</td>
                                @else
                                    <td class="BGyellow pl-1" colspan="3"
                                        style="border:2px solid black; font-size:10px;">Validée le :
                                        {{ $infosNDF[0]->DateValidation }}</td>
                                @endif

                                <td class="TD-table text-center" colspan="4">{{ $SousTotalTransport }} €</td>
                                <td class="TD-table text-center BGnuit" colspan="1"></td>
                                <td class="TD-table text-center" colspan="2" style="border-right:2px solid red">
                                    {{ $SousTotalRepasHotels }} €</td>
                                <td class="TD-table text-center" colspan="2" style="border:2px solid red">
                                    Remboursement
                                    essence {{ round($totalKilometres * $utilisateurs[0]->taux, 2) }}
                                    €{{-- * prix de l'essence --}}
                                </td>


                            </tr>
                            <tr>
                                <td class="BGyellow pl-1" style="border:2px solid black; font-size:10px;"
                                    colspan="2">
                                    TOTAL HT : {{ $total - ($totalTVA10 + $totalTVA20) }} €</td>
                                @if (count($infosNDF) == 0)
                                    <td class="BGyellow pl-1" colspan="3" rowspan="1"
                                        style="border:2px solid black; font-size:10px;">Pas encore soumise</td>
                                @else
                                    <td class="BGyellow pl-1" colspan="3" rowspan="1"
                                        style="border:2px solid black; font-size:10px;">Validée par :
                                        {{ $infosNDF[0]->ValideePar }}</td>
                                @endif
                                <td class="TD-table text-center BGgris" colspan="4">
                                    {{ $SousTotalTransport - $totalTVA20 }} € HT</td>
                                <td class="TD-table text-center BGnuit" colspan="1"></td>
                                <td class="TD-table text-center BGgris" colspan="2">
                                    {{ round($SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux - $totalTVA10, 2) }}
                                    € HT</td>
                                <td class="TD-table text-center BGnuit" colspan="2"></td>

                            </tr>
                            <tr>
                                <td class="BGyellow pl-1 text-center" colspan="5"
                                    style="border:2px solid black; font-size:10px;">{{ count($utilisateurs) }}
                                    déplacements
                                </td>

                                <td class="TD-table text-center" colspan="9" style="font-size: 16px !important;">
                                    Total
                                    {{ $total }} € TTC</td>
                            </tr>

                        </tbody>


                    </table>
                    @foreach ($utilisateurs as $utilisateur)
                        {{-- <div class="flex justify-around items-center">ouais le pdf appartenant a {{ $utilisateur->name }}</div> --}}
                    @endforeach


                    {{-- <table class="pt-4 mt-5">

                        <tbody>
                            <tr>
                                <td class="TD-table text-center">Taux : {{ $utilisateurs[0]->taux }} € / km</td>
                            </tr>
                            <tr>
                                <td class="TD-table text-center">Dt TVA : {{ $totalTVA20 + $totalTVA10 }} €</td>
                            </tr>
                            <tr>
                                <td class="TD-table text-center">Dt TOTAL HT:
                                    {{ $total - ($totalTVA10 + $totalTVA20) }} €</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
            </div>


</x-app-layout>
