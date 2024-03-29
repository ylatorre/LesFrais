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
        $totalaEmporter = 0;
        $totalTVA20 = 0;
        $totalTVA10 = 0;
        $totalTVA55 = 0;
    @endphp


    <style>
        .TH-table {
            font-size: 8px;
            border: 1px solid black;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            padding-left: 6px;
            padding-right: 6px;
            height: 30px;
        }

        .TD-table {
            font-size: 7px;
            border: 1px solid black;
            padding-right: 6px;
            padding-left: 6px;
            max-height: 43px;
            max-width: 80px;
            white-space: nowrap;
            overflow: hidden;
        }

        .TD-table-2 {
            font-size: 7px;
            border-bottom: 1.5px solid black;
            border-top: 1.5px solid black;
            padding-right: 6px;
            padding-left: 6px;
        }

        .TD-table-3 {
            font-size: 10px;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            padding-right: 6px;
            padding-left: 6px;
        }

        .col-table {
            font-size: 7px;
            border: 1px solid black;
            padding: 2px;
        }

        .tablepdf {
            border-collapse: collapse;
            border:2px solid black;

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

        .BGgrisclair {
            background: rgb(190, 190, 190);
        }

        .BGnuit {
            background: black;
        }

        .BGred {
            background: rgba(255, 0, 0, 0.3);
        }

        .td-top-table {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
    {{-- <div class="text-center"> --}}
    <table style="margin-bottom:20px; width:100%;">
        <tr>
            <td>
                <img src="./images/logoCDIT.png" alt="logoCDIT" width="200px" height="50px">
            </td>




        </tr>

    </table>
    <h1 style="position:fixed; right:0px; top:20px; text-center">Note de frais de {{ $utilisateurs[0]->name }} pour
        {{ $dateNDFpourPDFetVISU }} <br><em style="font-size:10px;">( Les valeurs sont exprimées en euros )</em></h1>

    {{--    <h1 class="">dawd</h1> --}}
    <div class="w-full flex flex-row justify-around">
        <div>
            <table class="tablepdf">
                <thead>
                    <th class="TH-table text-center BGjour"
                        style="border-top:2px solid black; border-left:2px solid black; border-right:1.5px solid black;border-bottom:1px solid black;">
                        Jours</th>
                    <th class="TH-table text-center w-10" style="border-bottom:1px solid black;">Client / Prospect</th>
                    <th class="TH-table text-center w-10" style="border-bottom:1px solid black;">Code Postal</th>
                    <th class="TH-table text-center w-10" style="border-bottom:1px solid black;">Ville</th>
                    <th class="TH-table text-center "
                        style="width:100px; border-right:1.5px solid black; border-bottom:1px solid black;">Description
                    </th>
                    {{--            <tr colspan="4">TTC            </tr> --}}


                    <th colspan="4" class="TH-table text-center BGblue"
                        style="padding-left:50px; padding-right:50px; border-bottom:1px solid black; ">Péages</th>
                    <th class="TH-table text-center BGblue" style="border-bottom:1px solid black;">Parking</th>
                    <th class="TH-table text-center BGblue" style="border-bottom:1px solid black;">Essence</th>
                    <th class="TH-table text-center BGblue" style="border-bottom:1px solid black;">Divers</th>
                    <th class="TH-table text-center BGblue"
                        style="white-space:nowrap; border-right:1.5px solid black; border-bottom:1px solid black; ">TVA
                        (20%)</th>
                    <th class="TH-table text-center BGyellow" style="border-bottom:1px solid black;">Petit Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border-bottom:1px solid black;">Déjeuner</th>
                    <th class="TH-table text-center BGyellow" style="border-bottom:1px solid black;">Dîner</th>
                    <th class="TH-table text-center BGyellow" style="border-bottom:1px solid black;">Hotels</th>
                    <th class="TH-table text-center BGyellow"
                        style="border-right:1.5px solid black; border-bottom:1px solid black;">TVA (10%)</th>

                    <th class="TH-table text-center BGred" style="border-bottom:1px solid black;">Repas à emporter</th>
                    <th class="TH-table text-center BGred"
                        style="border-bottom:1px solid black; border-right:1.5px solid black;">TVA (5,5%)</th>

                    <th class="TH-table text-center BGgreen w-16"
                        style="white-space:nowrap; border-bottom:1px solid black; border-right:2px solid black;">
                        Km
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
                            $totalaEmporter = $utilisateur->aEmporter + $totalaEmporter;
                            $totalKilometres = $utilisateur->kilometrage + $totalKilometres;
                            $totalTVA20 = round((($utilisateur->divers + $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) + $totalTVA20;
                            $totalTVA10 = round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) + $totalTVA10;
                            $totalTVA55 = round(($utilisateur->aEmporter / 1.055) * 0.055, 2) + $totalTVA55;
                            $totaltot = 0;
                            $totalTVAtot = round((($totalRepas + $totalHotels) / 1.1) * 0.1, 2);

                            /* régler le probleme de la tva et du total tva içi*/

                        @endphp



                        <tr>
                            <!-- Valeurs dans le tableau -->
                            <td class="TD-table-2 text-center BGjour"
                                style="white-space: nowrap; border-left:2px solid black; border-right:1.5px solid black; border-top:1px solid black;">
                                du
                                {{ $datedebut }}<br> au {{ $datefin }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->title }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->code_postal }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->ville }}</td>
                            <td class="TD-table col-table text-center"
                                style="white-space:nowrap; max-width: 10px; overflow:hidden; border-right:1.5px solid black;">
                                {{ $utilisateur->description }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage2 }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage3 }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->peage4 }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->parking }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->essence }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->divers }}</td>
                            <td class="TD-table text-center BGgrisclair"
                                style="border-right:1.5px solid black; border-left:1px solid black;">
                                {{ round((($utilisateur->divers + $utilisateur->peage + $utilisateur->peage2 + $utilisateur->peage3 + $utilisateur->peage4 + $utilisateur->essence + $utilisateur->parking) / 1.2) * 0.2, 2) }}
                            </td>
                            <td class="TD-table text-center">{{ $utilisateur->petitDej }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->dejeuner }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->diner }}</td>
                            <td class="TD-table text-center">{{ $utilisateur->hotel }}</td>
                            <td class="TD-table text-center BGgrisclair"
                                style="border-left:1px solid black; border-right:1.5px solid black;">
                                {{ round((($utilisateur->petitDej + $utilisateur->dejeuner + $utilisateur->diner + $utilisateur->hotel) / 1.1) * 0.1, 2) }}
                            </td>

                            <td class="TD-table text-center" style="border-top:1px solid black; ">
                                {{ $utilisateur->aEmporter }}</td>
                            <td class="TD-table text-center BGgrisclair"
                                style="border-right:1.5px solid black; border-left:1px solid black;border-top:1px solid black;">
                                {{ round(($utilisateur->aEmporter / 1.055) * 0.055, 2) }}</td>

                            <td class=" col-table text-center"
                                style="width:60px; border-right:2px solid black; border-bottom:1.5px solid black; ">
                                {{ $utilisateur->kilometrage }} </td>


                        </tr>
                        @php
                            $compteur = $compteur + 1;
                        @endphp
                        @if ($compteur > 13)
                </tbody>
            </table>

            <h1 class="text-center "
                style="margin-top:50px; position:relative;  white-space:nowrap; font-size: 7px; bottom:0px; color:#202020; bottom:0px;">
                Carpe Diem SARL au capital de 16 640 € | 42 Chemin du Moulin Carron - Le Norly 1 - Bâtiment A2 - 69130
                ECULLY | Siret : 403 030 349 00050 | Tél : 0170.809.809</h1>
            <div style="page-break-after: always;"></div>
            <table class="tablepdf">
                <thead>
                    <th
                        class="TH-table text-center BGjour"style="border-top:2px solid black; border-left:2px solid black; border-right:1.5px solid black;border-bottom:1px solid black;">
                        Jours</th>
                    <th class="TH-table text-center w-10">Client / Prospect</th>
                    <th class="TH-table text-center w-10">Ville</th>
                    <th class="TH-table text-center w-10">Code Postal</th>
                    <th class="TH-table text-center w-16" style="border-right:1.5px solid black">Description</th>
                    <th colspan="4" class="TH-table text-center BGblue">Péages</th>
                    <th class="TH-table text-center BGblue">Parking</th>
                    <th class="TH-table text-center BGblue">Essence</th>
                    <th class="TH-table text-center BGblue">Divers</th>
                    <th class="TH-table text-center BGblue" style="white-space:nowrap; border-right:1.5px solid black">
                        TVA
                        (20%)
                    </th>
                    <th class="TH-table text-center BGyellow">Petit Déjeuner</th>
                    <th class="TH-table text-center BGyellow">Déjeuner</th>
                    <th class="TH-table text-center BGyellow">Diner</th>
                    <th class="TH-table text-center BGyellow">Hotels</th>
                    <th class="TH-table text-center BGyellow" style="border-right:1.5px solid black">TVA (10%)</th>
                    <th class="TH-table text-center BGred">Repas à emporter</th>
                    <th class="TH-table text-center BGred">TVA (5,5%)</th>

                    <th class="TH-table text-center BGgreen">
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

                    {{-- Totaux par input --}}
                    <td colspan="5"
                        style="background: rgb(175, 175, 175) !important; border-left :1.5px solid black; border-right :1.5px solid black; border-top :1.5px solid black; border-bottom :1.5px solid black;">
                    </td>
                    <td colspan="4" class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black; ">
                        {{ $totalPeage }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black;">
                        {{ $totalParking }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black;">
                        {{ $totalEssence }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black;">
                        {{ $totalDivers }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1.5px solid black;">
                        {{ $totalTVA20 }} </td>
                    <td colspan="3" class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black;">
                        {{ $totalRepas }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black;">
                        {{ $totalHotels }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-bottom:1.5px solid black; border-right:1.5px solid black;">
                        {{ $totalTVA10 }} </td>
                    <td class="TD-table text-center"
                        style="background: rgb(175, 175, 175) !important; border-right:1px solid black; border-top:1.5px solid black;">
                        {{ $totalaEmporter }} </td>
                    <td class="TD-table text-center"
                        style="background: rgb(175, 175, 175) !important; border-top:1px solid black; border-right:1.5px solid black; border-top:1.5px solid black;">
                        {{ $totalTVA55 }} </td>
                    <td class="TD-table-2 text-center"
                        style="background: rgb(175, 175, 175) !important; border-bottom:1.5px solid black; border-right:2px solid black;">
                        {{ $totalKilometres }} </td>

                    {{-- Bas du tableau du PDF avec les totaux --}}

                </tr>
                <tr>
                    @if ($utilisateurs[0]->chevauxFiscaux > 1)
                        <td class=" pl-1 text-center"
                            style="border-top:1.5px solid black; font-size:7px; border-right:1.5px solid black; border-bottom:1.5px solid black; border-left:2px solid black"
                            colspan="2" rowspan="1">Puissance fiscale de
                            {{ $utilisateurs[0]->chevauxFiscaux }} chevaux fiscaux <br> pour un taux de
                            {{ $utilisateurs[0]->taux }} € / km</td>
                    @endif
                    @if ($utilisateurs[0]->chevauxFiscaux == 1)
                        <td class=" pl-1 text-center"
                            style="border-top:1.5px solid black; font-size:7px; border-right:2px solid black; border-bottom:1.5px solid black; border-left:2px solid black"
                            colspan="2" rowspan="1">Puissance fiscale de
                            {{ $utilisateurs[0]->chevauxFiscaux }} cheval fiscal <br> pour un taux de
                            {{ $utilisateurs[0]->taux }} € / km</td>
                    @endif
                    @if ($utilisateurs[0]->chevauxFiscaux == 0)
                        <td class=" pl-1 text-center"
                            style="border-top:1.5px solid black; font-size:7px; border-right:2px solid black; border-bottom:1.5px solid black; border-left:2px solid black"
                            colspan="2" rowspan="1">Puissance fiscale
                            nulle <br> pour un taux de
                            {{ $utilisateurs[0]->taux }} € / km</td>
                    @endif


                    <td class=" pl-1 text-center" colspan="3"
                        rowspan="1"style="border-top:1.5px solid black; font-size:8px; border-right:1.5px solid black; border-bottom:1.5px solid black; border-left:1.5px solid black">
                        Vous avez soumis cette note de frais le
                        {{ $infosNDF[0]->DateSoumission }}<br>et elle a été validée le
                        {{ $infosNDF[0]->DateValidation }}
                        par {{ $infosNDF[0]->ValideePar }}</td>

                    <td class="TD-table-3 text-center"
                        style="border-right:1.5px solid black; border-top:1.5px solid black;" rowspan="2"
                        colspan="5">Total HT :
                        {{ $SousTotalTransport - $totalTVA20 + ($SousTotalRepasHotels - $totalTVA10) + ($totalaEmporter - $totalTVA55) }}
                        €</td>
                    <td class="TD-table-3 text-center"
                        style="border-right:1.5px solid black; border-top:1.5px solid black;" rowspan="2"
                        colspan="3">Total TVA :
                        {{ $totalTVA20 + $totalTVA10 + $totalTVA55 }} €</td>
                    <td class="TD-table-3 text-center"
                        style="border-right:1.5px solid black; border-top:1.5px solid black;" rowspan="2"
                        colspan="3" style="border-right:2px solid black">Total TTC :
                        {{ $SousTotalRepasHotels + $SousTotalTransport + $totalaEmporter }} € </td>
                    <td class="TD-table-3 text-center"
                        style="border-right:1.5px solid black; border-top:1.5px solid black;" rowspan="2"
                        colspan="3">
                        Indemnité Km : {{ round($totalKilometres * $utilisateurs[0]->taux, 2) }} €</td>
                    <td class="TD-table-3 text-center font-bold" rowspan="2" colspan="2"
                        style="border-right:2px solid black; border-top:1.5px solid black;">
                        Total dû :
                        {{ $SousTotalRepasHotels + $SousTotalTransport + $totalaEmporter + $totalKilometres * $utilisateurs[0]->taux }}
                        €
                    </td>
                </tr>

                <tr>
                    @if (explode(' ', $dateNDFpourPDFetVISU)[0] == 'août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'octobre')
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous avez fait {{ count($utilisateurs) }} déplacements au mois
                            d'{{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif((explode(' ', $dateNDFpourPDFetVISU)[0] == 'août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'octobre') &&
                        count($utilisateurs) == 1)
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous avez fait {{ count($utilisateurs) }} déplacement au mois
                            d'{{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif((explode(' ', $dateNDFpourPDFetVISU)[0] == 'août' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'avril' ||
                        explode(' ', $dateNDFpourPDFetVISU)[0] == 'octobre') &&
                        count($utilisateurs) == 0)
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous n'avez pas fait de déplacement au mois
                            d'{{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif(count($utilisateurs) == 0)
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous n'avez pas fait de déplacement au mois de
                            {{ $dateNDFpourPDFetVISU }}
                        </td>
                    @elseif(count($utilisateurs) == 1)
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous avez fait {{ count($utilisateurs) }} déplacement au mois de
                            {{ $dateNDFpourPDFetVISU }}
                        </td>
                    @else
                        <td class=" pl-1 text-center" colspan="5" style="border:1.5px solid black; font-size:10px;">
                            Vous avez fait {{ count($utilisateurs) }} déplacements au mois de
                            {{ $dateNDFpourPDFetVISU }}
                        </td>
                    @endif
                </tr>

                </tbody>


            </table>
            <h1 class="text-center"
                style="position:fixed; margin-top:18px;  white-space:nowrap; font-size: 8px; bottom:0px; left:21%; color:#202020;">
                Carpe Diem SARL au capital de 16 640 € | 42 Chemin du Moulin Carron - Le Norly 1 - Bâtiment A2 - 69130
                ECULLY | Siret : 403 030 349 00050 | Tél : 0170.809.809</h1>

</body>

</html>
