<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Note de frais </title>

    <!-- Fonts -->


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
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
        $totalRepas = 0;
        $totalHotels = 0;
        $totalKilometres = 0;
        $SousTotalTransport = 0;
        $SousTotalRepasHotels = 0;
        $totalTVA20 = 0;
        $totalTVA10 = 0;
    @endphp
    <img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">

    <style>
        .TH-table {
            font-size: 8px;
            border: 1px solid black;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            padding: 2px;
            height: 40px;
        }

        .TD-table {
            font-size: 7px;
            border: 1px solid black;
            padding: 2px;
            max-height: 43px;
            max-width: 80px;
            overflow: hidden;
        }

        .TD-table-2 {
            font-size: 7px;
            border: 2px solid black;
            padding: 2px;
        }

        .col-table {
            font-size: 7px;
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

        .td-top-table {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
    {{-- <div class="text-center"> --}}
    <table style=" border:2px solid black; margin-top:1%; margin-bottom:1%;">
        <tr>
            <td class="td-top-table">Prénom / Nom</td>
            <td class="td-top-table">{{ $utilisateurs[0]->name }}</td>
        </tr>
        <tr>

            <td colspan="2" class="td-top-table">Note de frais pour {{ $dateNDFpourPDFetVISU }}</td>
        </tr>

    </table>
    {{--    <h1 class="">dawd</h1> --}}
    <div class="w-full flex flex-row justify-around">
        <div>
            <table class="tablepdf">
                <thead>
                    <th class="TH-table text-center BGjour" style="border: 2px solid black">Jours</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Client / Prospect</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Code Postal</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Ville</th>
                    <th class="TH-table text-center w-16" style="border: 2px solid black">description</th>
                    {{--            <tr colspan="4">TTC            </tr> --}}

                    <th class="TH-table text-center BGblue" style="border: 2px solid black;">P1</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black;">P2</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black;">P3</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black;">P4</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Parking</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Essence</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Divers</th>
                    <th class="TH-table text-center BGblue" style="white-space:nowrap; border: 2px solid black">TVA (20%)</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Petit Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Diner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Hotels</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">TVA (10%)</th>

                    <th class="TH-table text-center BGgreen w-16" style="white-space:nowrap;border:2px solid black;">{{ $infosNDF[0]->tauxKM }}
                        € / km
                    </th>

                </thead>
                <tbody>


                    @php
                        $compteur = 0;
                    @endphp




                    @foreach ($utilisateurs as $utilisateur)
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

                            $totalPeage = $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $totalPeage;
                            $totalParking = $utilisateur->parking + $totalParking;
                            $totalEssence = $utilisateur->essence + $totalEssence;
                            $totalDivers = $utilisateur->divers + $totalDivers;
                            $totalRepas = $utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $totalRepas;
                            $totalHotels = $utilisateur->hotel + $totalHotels;
                            $totalKilometres = $utilisateur->kilometrage + $totalKilometres;
                            $totalTVA20 = round((($utilisateur->divers + $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) + $totalTVA20;
                            $totalTVA10 = round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) + $totalTVA10;
                            $totaltot = 0;
                            $totalTVAtot = round(($totalRepas + $totalHotels) * 0.1, 2);

                            /* régler le probleme de la tva et du total tva içi*/

                        @endphp



                        <tr>
                            <!-- Valeurs dans le tableau -->
                            <td class="TD-table-2 text-center BGjour" style="white-space: nowrap;">du
                                {{ $datedebut }}<br> au {{ $datefin }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->title }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->code_postal }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->ville }}</td>
                            <td class="TD-table col-table text-center"
                                style="white-space:nowrap; max-width: 10px; overflow:hidden; border-right:2px solid black;">
                                {{ $utilisateur->description }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage2 }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage3 }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage4 }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->parking }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->essence }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->divers }} €</td>
                            <td class="TD-table text-center" style="border-right:2px solid black;">
                                {{ round((($utilisateur->divers + $utilisateur->peage + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) }}
                                €</td>
                            <td class="TD-table text-center">{{ $utilisateur->petitDej }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->dejeuner }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->diner }} €</td>
                            <td class="TD-table text-center">{{ $utilisateur->hotel }} €</td>
                            <td class="TD-table text-center">
                                {{ round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) }} €</td>

                            <td class=" col-table text-center" style="border: 2px solid black">
                                {{ $utilisateur->kilometrage }} km</td>


                        </tr>
                        @php
                            $compteur = $compteur + 1;
                        @endphp
                        @if ($compteur > 26)
                </tbody>
            </table>

            <h1 class="text-center "
                style="margin-top:50px; position:relative;  white-space:nowrap; font-size: 7px; bottom:0px; color:#202020; bottom:0px;">
                Carpe Diem SARL au capital de 16 640 € | 42 Chemin du Moulin Carron - Le Norly 1 - Bâtiment A2 - 69130
                ECULLY | Siret : 403 030 349 00050 | Tél : 0170.809.809</h1>
            <div style="page-break-after: always;"></div>
            <table class="tablepdf">
                <thead>
                    <th class="TH-table text-center BGjour" style="border: 2px solid black">Jours</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Client / Prospect</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Ville</th>
                    <th class="TH-table text-center w-10" style="border: 2px solid black">Code Postal</th>
                    <th class="TH-table text-center w-16" style="border: 2px solid black">description</th>
                    {{--            <tr colspan="4">TTC            </tr> --}}

                    <th class="TH-table text-center BGblue" style="border: 2px solid black;">Péage</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Parking</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Essence</th>
                    <th class="TH-table text-center BGblue" style="border: 2px solid black">Divers</th>
                    <th class="TH-table text-center BGblue" style="white-space:nowrap; border: 2px solid black">TVA (20%)</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Petit Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Diner</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Hotels</th>
                    <th class="TH-table text-center BGyellow" style="border: 2px solid black">Dt TVA (10%)</th>

                    <th class="TH-table text-center BGgreen" style="border:2px solid black;">
                        {{ $infosNDF[0]->tauxKM }}
                        € / km
                    </th>
                </thead>
                </tbody>
                @php
                    $compteur = 0;
                @endphp
                @endif
                @endforeach


                @php
                    $SousTotalTransport = $totalDivers + $totalEssence + $totalPeage + $totalParking;
                    $SousTotalRepasHotels = $totalRepas + $totalHotels;
                    $DtTotalTVAHotelRepasKM = $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux - $totalTVAtot;
                    $total = round($SousTotalTransport + $SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux, 2);
                @endphp
                <tr>
                    <td class="BGyellow pl-1 text-center" style="border:2px solid black; font-size:10px;"
                        colspan="2" rowspan="3">Pour une puissance fiscale de
                        {{ $utilisateurs[0]->chevauxFiscaux }} chevaux fiscaux <br>Taux :
                        {{ $utilisateurs[0]->taux }} € / km</td>

                    <td class="BGyellow pl-1 text-center" colspan="3"
                        rowspan="3"style="border:2px solid black; font-size:10px;">Note de frais soumise le
                        {{ $infosNDF[0]->DateSoumission }}<br>et validée le {{ $infosNDF[0]->DateValidation }}<br>
                        par {{ $infosNDF[0]->ValideePar }}</td>



                    <td colspan="4" class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalPeage }} €</td>
                    <td class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalParking }} €</td>
                    <td class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalEssence }} €</td>
                    <td class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalDivers }} €</td>
                    <td class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalTVA20 }} €</td>
                    <td colspan="3" class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalRepas }} €</td>
                    <td class="TD-table-2 text-center" style="background: rgb(175, 175, 175) !important;">
                        {{ $totalHotels }} €</td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-bottom:2px solid red;">
                        {{ $totalTVA10 }} €</td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-bottom:2px solid red;">
                        {{ $totalKilometres }} Km</td>


                    {{--        <td class="TD-table">{{$totalParking}}</td> --}}
                    {{--        <td class="TD-table">{{$totalEssence}}</td> --}}
                    {{--        <td class="TD-table">{{$totalDivers}}</td> --}}
                </tr>
                <tr>



                    <td class="TD-table-2 text-center" colspan="7">{{ $SousTotalTransport }} € TTC</td>
                    <td class="TD-table-2 text-center BGnuit" colspan="1"></td>
                    <td class="TD-table-2 text-center" colspan="4" style="border-right:2px solid red">
                        {{ $SousTotalRepasHotels }} € TTC</td>
                    <td class="TD-table-2 text-center" colspan="1" style="border:2px solid red">Remboursement
                        carburant {{-- * prix de l'essence --}}
                    </td>
                    <td class="TD-table-2 text-center" colspan="1" style="border:2px solid red">
                        {{ round($totalKilometres * $utilisateurs[0]->taux, 2) }} €{{-- * prix de l'essence --}}
                    </td>


                </tr>
                <tr>



                    <td class="TD-table-2 text-center BGgris" colspan="7">
                        {{ $SousTotalTransport - $totalTVA20 }} € HT</td>
                    <td class="TD-table-2 text-center BGnuit" colspan="1"></td>
                    <td class="TD-table-2 text-center BGgris" colspan="4">
                        {{ round($SousTotalRepasHotels + $totalKilometres * $utilisateurs[0]->taux - $totalTVA10, 2) }}
                        € HT</td>
                    <td class="TD-table-2 text-center BGnuit" colspan="2"></td>

                </tr>
                <tr>
                    @if ((explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre') &&
                        count($utilisateurs) == 1)
                        <td class="BGyellow pl-1 text-center" colspan="5"
                            style="border:2px solid black; font-size:10px;">Votre déplacement pour le mois
                            d'{{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif(explode(' ', $dateNDFpourPDFetVISU)[0] == 'Août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'Octobre')
                        <td class="BGyellow pl-1 text-center" colspan="5"
                            style="border:2px solid black; font-size:10px;">Vos {{ count($utilisateurs) }}
                            déplacements pour le mois d'{{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif(count($utilisateurs) == 1)
                        <td class="BGyellow pl-1 text-center" colspan="5"
                            style="border:2px solid black; font-size:10px;">Votre déplacement pour le mois de
                            {{ $dateNDFpourPDFetVISU }}
                        </td>
                    @else
                        <td class="BGyellow pl-1 text-center" colspan="5"
                            style="border:2px solid black; font-size:10px;">Vos {{ count($utilisateurs) }}
                            déplacements pour le mois de
                            {{ $dateNDFpourPDFetVISU }}
                        </td>
                    @endif

                    <td class="TD-table-2 text-center" colspan="6" style="font-size: 10px !important;">Total HT
                        : {{ $total - ($totalTVA20 + $totalTVA10) }} €</td>

                    <td class="TD-table-2 text-center" colspan="4" style="font-size: 10px !important;">Total TVA
                        : {{ $totalTVA20 + $totalTVA10 }} €</td>

                    <td class="TD-table-2 text-center" colspan="4" style="font-size: 10px !important;">Total TTC
                        : {{ $total }} €</td>
                </tr>

                </tbody>


            </table>
            <h1 class="text-center"
                style="position:fixed; margin-top:18px;  white-space:nowrap; font-size: 8px; bottom:0px; left:8%; color:#202020;">
                Carpe Diem SARL au capital de 16 640 € | 42 Chemin du Moulin Carron - Le Norly 1 - Bâtiment A2 - 69130
                ECULLY | Siret : 403 030 349 00050 | Tél : 0170.809.809</h1>
            {{-- <h1 style="color:grey; font-size:8px; text-align:center; ">Carpe Diem SARL au capital de 16 640 € | 42 Chemin du Moulin Carron - Le Norly 1 -
                Bâtiment A2 - 69130 ECULLY | Siret : 403 030 349 00050 | Tél : 0170.809.809</h1> --}}


            {{-- <table class="pt-4">

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
</table> --}}




</body>

</html>
